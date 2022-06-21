<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Models\Chat;
use App\Actions\Response;

final class GetChatByUserIdResponse implements Response
{
    private ?Chat $chatId;

    public function __construct(?Chat $chatId)
    {
        $this->chatId = $chatId;
    }

    public function getResponse(): ?Chat
    {
        return $this->chatId;
    }
}
