<?php

declare(strict_types=1);

namespace App\Repositories\Order\Criterion;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class OrdersByUserSellerLoginCriterion
{
    private string $userSellerLogin;

    public function __construct(string $userSellerLogin)
    {
        $this->userSellerLogin = $userSellerLogin;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->leftJoin('users as users_sellers', 'users_sellers.id', '=', 'orders.user_seller_id')
            ->where(
                DB::raw('LOWER(users_sellers.login)'),
                'like',
                "%{$this->userSellerLogin}%"
            )
            ->select('orders.*');
    }
}
