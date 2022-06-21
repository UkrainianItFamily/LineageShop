<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function save(Product $product): Product;

    public function update(Product $product): Product;

    public function delete(Product $product): void;

    public function getById(int $productId): ?Product;

    public function findByCriteria(
        array $criteria,
        string $orderType,
        string $orderDirection
    ): Collection;

    public function findByCriteriaPagination(
        array $criteria,
        string $orderType,
        string $orderDirection
    ): LengthAwarePaginator;

    public function checkExistByCriteria(array $criteria): ?Product;

    public function getProductAvailabilityColumn($productId): ?Product;
}
