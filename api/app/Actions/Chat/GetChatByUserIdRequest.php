<?php

declare(strict_types=1);

namespace App\Actions\Chat;

final class GetChatByUserIdRequest
{
    private int $secondUserId;

    public function __construct(int $secondUserId)
    {
        $this->secondUserId = $secondUserId;
    }

    public function getSecondUserId(): int
    {
        return $this->secondUserId;
    }
}
