<?php

declare(strict_types=1);

namespace App\Repositories\SupportRequest\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class BetweenDateCriterion
{
    private ?string $startDate;
    private ?string $endDate;

    public function __construct(?string $startDate, ?string $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->WhereBetween(
            'created_at',
            [ $this->startDate, $this->endDate]
        );
    }
}
