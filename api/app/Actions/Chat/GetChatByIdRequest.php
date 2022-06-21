<?php

declare(strict_types=1);

namespace App\Actions\Chat;

final class GetChatByIdRequest
{
    private int $chatId;

    public function __construct(int $chatId)
    {
        $this->chatId = $chatId;
    }

    public function getChatId(): int
    {
        return $this->chatId;
    }
}
