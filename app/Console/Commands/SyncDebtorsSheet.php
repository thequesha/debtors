<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoogleSheetsSyncService;
use App\Services\GoogleSheetUrlService;
use Illuminate\Support\Facades\Log;

class SyncDebtorsSheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:debtors-sheet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronise Google Sheet with debtors data (import comments, export allowed)';

    public function __construct(
        protected GoogleSheetsSyncService $syncService,
        protected GoogleSheetUrlService $urlService
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $sheetUrlModel = $this->urlService->get();
        if (!$sheetUrlModel || !$sheetUrlModel->url) {
            $this->info('No Google Sheet URL configured.');
            return Command::SUCCESS;
        }

        // Extract spreadsheet ID from URL
        if (!preg_match('#/d/([a-zA-Z0-9-_]+)#', $sheetUrlModel->url, $m)) {
            $this->error('Invalid Google Sheet URL stored.');
            return Command::FAILURE;
        }
        $spreadsheetId = $m[1];

        $this->info('Importing comments from sheet...');
        $this->syncService->importComments($spreadsheetId);

        $this->info('Exporting allowed debtors to sheet...');
        $this->syncService->exportAllowed($spreadsheetId);

        $this->info('Sync completed.');
        Log::info('Debtors sheet synchronised');

        return Command::SUCCESS;
    }
}
