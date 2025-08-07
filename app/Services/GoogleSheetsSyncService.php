<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use App\Models\Debtor;

class GoogleSheetsSyncService
{
    protected Sheets $sheetsService;

    public function __construct()
    {
        $client = new Client();
        $client->setApplicationName('DebtorSync');
        $client->setScopes([Sheets::SPREADSHEETS]);

        $credentials = Config::get('google.credentials_json');

        // Support both file path and raw JSON string
        if (is_string($credentials) && file_exists($credentials)) {
            $client->setAuthConfig($credentials);
        } else {
            // treat as raw JSON
            $client->setAuthConfig(json_decode($credentials, true));
        }

        $this->sheetsService = new Sheets($client);
    }

    /**
     * Update DB comments from sheet rows (id, name, comment).
     */
    public function importComments(string $spreadsheetId, ?string $range = null): void
    {
        $range ??= Config::get('google.sheet_range', 'A:C');

        try {
            $response = $this->sheetsService->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();
            if (!$values) {
                return;
            }

            foreach ($values as $row) {
                if (count($row) < 1) {
                    continue; // row without ID
                }
                $id = $row[0];
                $comment = $row[2] ?? null;
                if (!is_numeric($id)) {
                    continue;
                }
                Debtor::where('id', (int)$id)->update(['comment' => $comment ?? null]);
            }
        } catch (\Throwable $e) {
            Log::error('Sheets import error: ' . $e->getMessage());
        }
    }

    /**
     * Export allowed debtors to sheet, overwriting existing data.
     */
    public function exportAllowed(string $spreadsheetId, ?string $range = null): void
    {
        $range ??= Config::get('google.sheet_range', 'A:C');
        $debtors = Debtor::allowed()->get(['id', 'name', 'comment']);
        $values = $debtors->map(fn($d) => [$d->id, $d->name, $d->comment])->toArray();

        try {
            // Clear existing values first
            $this->sheetsService->spreadsheets_values->clear($spreadsheetId, $range, new Sheets\ClearValuesRequest());

            $body = new Sheets\ValueRange([
                'values' => $values,
            ]);
            $params = ['valueInputOption' => 'RAW'];
            $this->sheetsService->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
        } catch (\Throwable $e) {
            Log::error('Sheets export error: ' . $e->getMessage());
        }
    }
}
