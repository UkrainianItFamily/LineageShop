<?php

declare(strict_types=1);

namespace App\Repositories\Product\Criterion;

use App\Constant\ProductConstant;
use Illuminate\Database\Eloquent\Builder;

final class IsActiveCriterion
{
    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'active',
            '=',
            ProductConstant::ACTIVE
        );
    }
}
