<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface DebtorRepositoryInterface
{
    /**
     * Paginate debtors list.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Bulk insert rows.
     */
    public function bulkInsert(array $rows): void;

    /**
     * Delete all debtors.
     */
    public function deleteAll(): void;
}
