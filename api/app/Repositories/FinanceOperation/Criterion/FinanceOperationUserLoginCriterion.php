<?php

declare(strict_types=1);

namespace App\Repositories\FinanceOperation\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class FinanceOperationUserLoginCriterion
{
    private string $userLogin;

    public function __construct(string $userLogin)
    {
        $this->userLogin = $userLogin;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->rightJoin('users', 'users.id', '=', 'finance_operations_histories.user_id')
            ->where('users.login', '=', $this->userLogin)
            ->select('finance_operations_histories.*');
    }
}
