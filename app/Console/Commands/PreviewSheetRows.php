<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoogleSheetsSyncService;
use App\Services\GoogleSheetUrlService;
use Google\Service\Sheets\ValueRange;

class PreviewSheetRows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sheet:preview {--count= : Max rows to display (omit for all)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports rows from Google Sheet and prints id/comment for each with a progress bar';

    public function __construct(
        private GoogleSheetsSyncService $syncService,
        private GoogleSheetUrlService $urlService
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $sheetUrlModel = $this->urlService->get();
        if (!$sheetUrlModel || !$sheetUrlModel->url) {
            $this->error('Google Sheet URL not configured.');
            return Command::FAILURE;
        }

        if (!preg_match('#/d/([a-zA-Z0-9-_]+)#', $sheetUrlModel->url, $m)) {
            $this->error('Invalid Google Sheet URL.');
            return Command::FAILURE;
        }
        $spreadsheetId = $m[1];
        $range = config('google.sheet_range', 'A:C');

        // Fetch raw values via Sheets API through the service's client
        $serviceReflection = new \ReflectionClass($this->syncService);
        $sheetsProp = $serviceReflection->getProperty('sheetsService');
        $sheetsProp->setAccessible(true);

        $sheets = $sheetsProp->getValue($this->syncService);

        $response = $sheets->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues() ?? [];

        $total = count($values);
        $limitOption = $this->option('count');
        $limit = $limitOption !== null ? (int) $limitOption : $total;

        $bar = $this->output->createProgressBar(min($total, $limit));
        $bar->start();
        $this->newLine(2);
        $printed = 0;
        foreach ($values as $row) {
            if ($printed >= $limit) {
                break;
            }
            $id = $row[0] ?? null;
            $comment = $row[2] ?? null;
            $this->line("ID: {$id} | Comment: {$comment}");
            $printed++;
            $bar->advance();
        }
        $bar->finish();
        $this->newLine(2);
        $this->info("Displayed {$printed} of {$total} rows.");

        return Command::SUCCESS;
    }
}
