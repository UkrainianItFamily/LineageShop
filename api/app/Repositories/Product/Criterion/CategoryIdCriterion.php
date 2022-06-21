<?php

declare(strict_types=1);

namespace App\Repositories\Product\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class CategoryIdCriterion
{
    private int $categoryId;

    public function __construct(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'category_id',
            $this->categoryId
        );
    }
}
