<?php

declare(strict_types=1);

namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function save(Message $message): Message
    {
        $message->save();

        return $message;
    }

    public function getMessagesByChatId(int $chatId, int $currentUserId): Collection
    {
        return Message::where('chat_id', $chatId)
            ->leftJoin('chats', function($join) use ($currentUserId)
            {
                $join->on('messages.chat_id', 'chats.id')
                    ->where('chats.first_user_id', $currentUserId)
                    ->orWhere('chats.second_user_id', $currentUserId);
            })->orderBy('messages.created_at', 'desc')
            ->select('messages.*')
            ->get();
    }
}
