<?php

declare(strict_types=1);

namespace App\Repositories\Order\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class OrdersByCustomerIdCriterion
{
    private int $customerId;

    public function __construct(int $customerId)
    {
        $this->customerId = $customerId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'user_customer_id',
            '=',
            $this->customerId
        );
    }
}
