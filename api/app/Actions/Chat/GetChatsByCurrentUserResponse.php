<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetChatsByCurrentUserResponse implements Response
{
    private Collection $chats;

    public function __construct(Collection $chats)
    {
        $this->chats = $chats;
    }

    public function getResponse(): Collection
    {
        return $this->chats;
    }
}
