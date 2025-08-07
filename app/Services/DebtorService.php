<?php

namespace App\Services;

use App\Repositories\Contracts\DebtorRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DebtorService
{
    public function __construct(private DebtorRepositoryInterface $debtors)
    {
    }

    /**
     * Paginate debtors list.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->debtors->paginate($perPage);
    }
}
