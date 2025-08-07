<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Sheets Integration
    |--------------------------------------------------------------------------
    |
    | credentials_json  - Absolute path to the service-account JSON key.
    |                     Example: storage_path('keys/sheets.json')
    |
    | sheet_range       - Range used when exporting/importing (A:C covers id, name, comment).
    |                     Can be overridden in the .env if needed.
    */

    'credentials_json' => env('GOOGLE_SHEETS_CREDENTIALS', storage_path('keys/sheets.json')),
    'sheet_range'      => env('GOOGLE_SHEETS_RANGE', 'A:C'),
];
