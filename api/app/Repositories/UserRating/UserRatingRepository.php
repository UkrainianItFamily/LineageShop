<?php

namespace App\Repositories\UserRating;

use App\Models\UserRating;
use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;

class UserRatingRepository extends BaseRepository implements UserRatingRepositoryInterface
{
    public function findByCriteria(array $criteria): Collection
    {
        $query = UserRating::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query->get();
    }
}
