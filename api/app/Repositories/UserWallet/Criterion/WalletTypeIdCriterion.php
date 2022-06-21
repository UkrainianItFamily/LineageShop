<?php

declare(strict_types=1);

namespace App\Repositories\UserWallet\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class WalletTypeIdCriterion
{
    private int $walletTypeId;

    public function __construct(int $walletTypeId)
    {
        $this->walletTypeId = $walletTypeId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'wallet_type_id',
            $this->walletTypeId
        );
    }
}
