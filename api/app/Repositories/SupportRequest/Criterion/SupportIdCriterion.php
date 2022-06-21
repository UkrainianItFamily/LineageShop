<?php

declare(strict_types=1);

namespace App\Repositories\SupportRequest\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class SupportIdCriterion
{
    private int $supportId;

    public function __construct(int $supportId)
    {
        $this->supportId = $supportId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'id',
            $this->supportId
        );
    }
}
