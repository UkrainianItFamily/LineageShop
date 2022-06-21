<?php

declare(strict_types=1);

namespace App\Repositories\Chat;

use App\Models\Chat;
use Illuminate\Support\Collection;

interface ChatRepositoryInterface
{
    public function save(Chat $chat): Chat;
    public function getChatByUsers(int $firstUserId, int $secondUserId): ?Chat;
    public function getChatsByUserId(int $userId): Collection;
    public function getChatById(int $chatId, int $userId): ?Chat;
}
