<?php

declare(strict_types=1);

namespace App\Repositories\Order\Criterion;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class OrdersByUserCustomerLoginCriterion
{
    private string $userCustomerLogin;

    public function __construct(string $userCustomerLogin)
    {
        $this->userCustomerLogin = $userCustomerLogin;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->leftJoin('users as users_customers', 'users_customers.id', '=', 'orders.user_customer_id')
            ->where(
                DB::raw('LOWER(users_customers.login)'),
                'like',
                "%{$this->userCustomerLogin}%"
            )
            ->select('orders.*');
    }
}
