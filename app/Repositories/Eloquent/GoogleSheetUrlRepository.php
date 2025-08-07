<?php

namespace App\Repositories\Eloquent;

use App\Models\GoogleSheetUrl;
use App\Repositories\Contracts\GoogleSheetUrlRepositoryInterface;

class GoogleSheetUrlRepository implements GoogleSheetUrlRepositoryInterface
{
    public function get(): ?GoogleSheetUrl
    {
        return GoogleSheetUrl::first();
    }

    public function save(string $url): GoogleSheetUrl
    {
        return GoogleSheetUrl::updateOrCreate(['id' => 1], ['url' => $url]);
    }
}
