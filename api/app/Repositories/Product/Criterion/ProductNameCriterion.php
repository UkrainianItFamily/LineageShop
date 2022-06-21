<?php


namespace App\Repositories\Product\Criterion;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


class ProductNameCriterion
{
    private string $productName;

    public function __construct(string $productName)
    {
        $this->productName = $productName;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            DB::raw('LOWER(name)'),
            'like',
            "%{$this->productName}%"
        );
    }
}
