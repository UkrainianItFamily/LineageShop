<?php

declare(strict_types=1);

namespace App\Repositories\FinanceOperation;

use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;
use App\Models\FinanceOperationsHistory;

class FinanceOperationRepository extends BaseRepository implements FinanceOperationRepositoryInterface
{
    public function save(FinanceOperationsHistory $newFinanceOperation): FinanceOperationsHistory
    {
        $newFinanceOperation->save();

        return $newFinanceOperation;
    }
    public function update(FinanceOperationsHistory $newFinanceOperation): FinanceOperationsHistory
    {
        $newFinanceOperation->update();

        return $newFinanceOperation;
    }

    public function getById(int $id): ?FinanceOperationsHistory
    {
        return FinanceOperationsHistory::firstWhere('id', $id);
    }

    public function findByCriteria(array $criteria): Collection
    {
        $query = FinanceOperationsHistory::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query->get();
    }
}
