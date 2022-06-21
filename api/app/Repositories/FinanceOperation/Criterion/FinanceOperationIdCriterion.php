<?php

declare(strict_types=1);

namespace App\Repositories\FinanceOperation\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class FinanceOperationIdCriterion
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'id',
            $this->id
        );
    }
}
