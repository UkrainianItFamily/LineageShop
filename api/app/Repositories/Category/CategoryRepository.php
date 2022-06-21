<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::all();
    }

    public function getById(int $id): ?Category
    {
        return Category::firstWhere('id', $id);
    }

    public function findByCriteria(
        array $criteria
    ): Collection {
        $query = Category::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query->get();
    }
}
