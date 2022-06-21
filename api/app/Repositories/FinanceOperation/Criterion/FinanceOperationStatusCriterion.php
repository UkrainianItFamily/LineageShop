<?php

declare(strict_types=1);

namespace App\Repositories\FinanceOperation\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class FinanceOperationStatusCriterion
{
    private int $statusId;

    public function __construct(int $statusId)
    {
        $this->statusId = $statusId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'status',
            $this->statusId
        );
    }
}
