<?php

declare(strict_types=1);

namespace App\Actions\UserRating;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetUserRatingByUserIdResponse implements Response
{
    private Collection $userRatings;

    public function __construct(Collection $userRatings)
    {
        $this->userRatings = $userRatings;
    }

    public function getResponse(): Collection
    {
        return $this->userRatings;
    }
}
