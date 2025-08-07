<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SheetController extends Controller
{
    /**
     * Fetch rows from Google Sheet via console command and return plain-text output.
     *
     * @param Request $request
     * @param int|null $count
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request, ?int $count = null)
    {
        $options = [];
        if ($count !== null) {
            $options['--count'] = $count;
        }

        Artisan::call('sheet:preview', $options);
        $output = Artisan::output();

        return response($output, 200)->header('Content-Type', 'text/plain');
    }
}
