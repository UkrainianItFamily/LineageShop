<?php

declare(strict_types=1);

namespace App\Repositories\Category\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class CategoriesIdCriterion
{
    private array $categoriesId;

    public function __construct(array $categoriesId)
    {
        $this->categoriesId = $categoriesId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->whereIn(
            'id',
            $this->categoriesId
        );
    }
}
