<?php

namespace App\Services;

use App\Repositories\Contracts\GoogleSheetUrlRepositoryInterface;
use App\Models\GoogleSheetUrl;

class GoogleSheetUrlService
{
    public function __construct(private GoogleSheetUrlRepositoryInterface $repo)
    {
    }

    public function get(): ?GoogleSheetUrl
    {
        return $this->repo->get();
    }

    public function save(string $url): GoogleSheetUrl
    {
        return $this->repo->save($url);
    }
}
