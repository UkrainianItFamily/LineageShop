<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Category;
    public function findByCriteria(array $criteria): Collection;
}
