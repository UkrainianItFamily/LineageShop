<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public const DEFAULT_ORDER_TYPE = 'id';
    public const DEFAULT_ORDER_DIRECTION = 'DESC';
    public const PER_PAGE = 15;

    public function save(Product $product): Product
    {
        $product->save();

        return $product;
    }

    public function update(Product $product): Product
    {
        $product->update();

        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }

    public function getById(int $id): ?Product
    {
        return Product::firstWhere('id', $id);
    }

    public function findByCriteria(
        array $criteria,
        string $orderType,
        string $orderDirection
    ): Collection {
        $query = Product::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query
            ->select('products.*')
            ->orderBy($orderType, $orderDirection)
            ->get();
    }

    public function findByCriteriaPagination(
        array $criteria,
        string $orderType,
        string $orderDirection
    ): LengthAwarePaginator {
        $query = Product::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query->select('products.*')
            ->orderBy($orderType, $orderDirection)
            ->paginate(self::PER_PAGE);
    }

    public function checkExistByCriteria(array $criteria): ?Product
    {
        $query = Product::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query->select('products.*')
            ->first();
    }

    public function getProductAvailabilityColumn($productId): ?Product
    {
        $quantity = Product::where('id', $productId)->get('availability')->first();

        return $quantity;
    }
}
