<?php

declare(strict_types=1);

namespace App\Repositories\Chat;

use App\Models\Chat;
use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;

class ChatRepository extends BaseRepository implements ChatRepositoryInterface
{
    public function save(Chat $chat): Chat
    {
        $chat->save();

        return $chat;
    }

    public function getChatByUsers(int $firstUserId, int $secondUserId): ?Chat
    {
        return Chat::where(function ($query) use ($firstUserId, $secondUserId) {
            $query->where('first_user_id', $firstUserId)
                ->where('second_user_id', $secondUserId);
        })
            ->orWhere(function ($query) use ($firstUserId, $secondUserId) {
                $query->where('first_user_id', $secondUserId)
                    ->where('second_user_id', $firstUserId);
            })->first();
    }

    public function getChatsByUserId(int $userId): Collection
    {
        return Chat::where('first_user_id', $userId)
                ->orWhere('second_user_id', $userId)
                ->get();
    }

    public function getChatById(int $chatId, int $userId): ?Chat
    {
        return Chat::where(function ($query) use ($chatId, $userId) {
            $query->where('first_user_id', $userId)
                ->where('id', $chatId);
        })
            ->orWhere(function ($query) use ($chatId, $userId) {
                $query->where('id', $chatId)
                    ->where('second_user_id', $userId);
            })->first();
    }
}
