<?php

declare(strict_types=1);

namespace App\Repositories\SupportRequest\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class AuthorIdCriterion
{
    private int $authorId;

    public function __construct(int $authorId)
    {
        $this->authorId = $authorId;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'author_id',
            $this->authorId
        );
    }
}
