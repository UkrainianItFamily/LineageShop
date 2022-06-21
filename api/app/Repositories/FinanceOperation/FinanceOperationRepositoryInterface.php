<?php

namespace App\Repositories\FinanceOperation;

use Illuminate\Support\Collection;
use App\Models\FinanceOperationsHistory;

interface FinanceOperationRepositoryInterface
{
    public function save(FinanceOperationsHistory $newFinanceOperation): FinanceOperationsHistory;
    public function update(FinanceOperationsHistory $newFinanceOperation): FinanceOperationsHistory;
    public function getById(int $id): ?FinanceOperationsHistory;
    public function findByCriteria(array $criteria): Collection;
}
