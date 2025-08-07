<?php

namespace App\Services;

use App\Repositories\Contracts\DebtorRepositoryInterface;
use Faker\Factory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DebtorService
{
    public function __construct(private DebtorRepositoryInterface $debtors) {}

    /**
     * Paginate debtors list.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->debtors->paginate($perPage);
    }

    /**
     * Generate a batch of random debtors.
     */
    public function generateBatch(int $total = 1000): void
    {
        $half = (int) ($total / 2);
        $faker = \Faker\Factory::create();

        $rows = [];
        $timestamp = now();

        for ($i = 0; $i < $half; $i++) {
            $rows[] = [
                'name' => $faker->name(),
                'status' => 'allowed',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        for ($i = 0; $i < $total - $half; $i++) {
            $rows[] = [
                'name' => $faker->name(),
                'status' => 'prohibited',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        shuffle($rows); // mix statuses

        // Chunk insert to avoid memory spikes if needed
        $chunkSize = 500;
        foreach (array_chunk($rows, $chunkSize) as $chunk) {
            $this->debtors->bulkInsert($chunk);
        }
    }

    /**
     * Delete all debtors.
     */
    public function deleteAll(): void
    {
        $this->debtors->deleteAll();
    }
}
