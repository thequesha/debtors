<?php

namespace App\Repositories\Contracts;

use App\Models\GoogleSheetUrl;

interface GoogleSheetUrlRepositoryInterface
{
    public function get(): ?GoogleSheetUrl;

    public function save(string $url): GoogleSheetUrl;
}
