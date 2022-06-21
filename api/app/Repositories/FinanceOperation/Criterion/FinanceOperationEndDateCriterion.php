<?php

declare(strict_types=1);

namespace App\Repositories\FinanceOperation\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class FinanceOperationEndDateCriterion
{
    private ?string $endDate;

    public function __construct(?string $endDate)
    {
        $this->endDate = $endDate;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->WhereDate(
            'created_at', '<=', $this->endDate
        );

    }
}
