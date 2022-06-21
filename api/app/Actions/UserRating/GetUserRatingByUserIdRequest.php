<?php

declare(strict_types=1);

namespace App\Actions\UserRating;

final class GetUserRatingByUserIdRequest
{
    private ?int $userId;

    public function __construct(?int $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
