<?php

declare(strict_types=1);

namespace App\Repositories\Order\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class OrderByIdCriterion
{
    private int $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'id',
            '=',
            $this->orderId
        );
    }
}
