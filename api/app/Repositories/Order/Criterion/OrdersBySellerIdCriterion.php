<?php

declare(strict_types=1);

namespace App\Repositories\Order\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class OrdersBySellerIdCriterion
{
    private int $sellerId;

    public function __construct(int $sellerId)
    {
        $this->sellerId = $sellerId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'user_seller_id',
            $this->sellerId
        );
    }
}
