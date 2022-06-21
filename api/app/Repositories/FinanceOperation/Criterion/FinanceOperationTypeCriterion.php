<?php

declare(strict_types=1);

namespace App\Repositories\FinanceOperation\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class FinanceOperationTypeCriterion
{
    private int $typeId;

    public function __construct(int $typeId)
    {
        $this->typeId = $typeId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'type',
            $this->typeId
        );
    }
}
