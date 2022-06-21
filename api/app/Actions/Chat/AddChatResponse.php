<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Actions\Response;
use App\Models\Chat;

final class AddChatResponse implements Response
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
