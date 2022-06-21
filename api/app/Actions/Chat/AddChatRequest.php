<?php

declare(strict_types=1);

namespace App\Actions\Chat;

final class AddChatRequest
{
    private int $recipientUserId;

    public function __construct(
        int $recipientUserId
    ) {
        $this->recipientUserId = $recipientUserId;
    }

    public function getRecipientUserId(): int
    {
        return $this->recipientUserId;
    }
}
