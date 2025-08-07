<?php

namespace App\Repositories\Eloquent;

use App\Models\Debtor;
use App\Repositories\Contracts\DebtorRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DebtorRepository implements DebtorRepositoryInterface
{
    /**
     * Paginate the debtors.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Debtor::query()->paginate($perPage);
    }
}
