<?php

declare(strict_types=1);

namespace App\Repositories\FinanceOperation\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class FinanceOperationSortCriterion
{
    private string $orderType;
    private string $orderDirection;

    public function __construct(
        string $orderType,
        string $orderDirection
    ) {
        $this->orderType = $orderType;
        $this->orderDirection = $orderDirection;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->orderBy(
            $this->orderType,
            $this->orderDirection
        );
    }
}
