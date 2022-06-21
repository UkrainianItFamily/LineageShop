<?php

declare(strict_types=1);

namespace App\Repositories\SupportRequest\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class StatusCriterion
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
            '=',
            $this->statusId
        );
    }
}
