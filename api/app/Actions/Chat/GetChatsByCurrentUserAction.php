<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Chat\ChatRepositoryInterface;

final class GetChatsByCurrentUserAction
{
    private ChatRepositoryInterface $chatRepository;

    public function __construct(ChatRepositoryInterface $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function execute(): GetChatsByCurrentUserResponse
    {
        $currentUserId = Auth::id();

        $chats = $this->chatRepository->getChatsByUserId($currentUserId);

        return new GetChatsByCurrentUserResponse($chats);
    }
}
