<?php

namespace App\Repositories\UserRating;

use Illuminate\Support\Collection;

interface UserRatingRepositoryInterface
{
    public function findByCriteria(array $criteria): Collection;
}
