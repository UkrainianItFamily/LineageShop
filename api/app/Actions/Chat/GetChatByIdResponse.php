<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Models\Chat;
use App\Actions\Response;

final class GetChatByIdResponse implements Response
{
    private Chat $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function getResponse(): Chat
    {
        return $this->chat;
    }
}
