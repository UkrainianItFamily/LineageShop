<?php

declare(strict_types=1);

namespace App\Repositories\Product\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class UserIdCriterion
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'user_id',
            $this->userId
        );
    }
}
