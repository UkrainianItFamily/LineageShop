<?php

declare(strict_types=1);

namespace App\Repositories\Message;

use App\Models\Message;
use Illuminate\Support\Collection;

interface MessageRepositoryInterface
{
    public function save(Message $message): Message;
    public function getMessagesByChatId(int $chatId, int $currentUserId): Collection;
}
