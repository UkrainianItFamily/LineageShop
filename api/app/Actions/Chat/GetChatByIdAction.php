<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\Chat\ChatNotFoundException;
use App\Repositories\Chat\ChatRepositoryInterface;

final class GetChatByIdAction
{
    private ChatRepositoryInterface $chatRepository;

    public function __construct(ChatRepositoryInterface $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function execute(GetChatByIdRequest $request): GetChatByIdResponse
    {
        $currentUserId = Auth::id();
        $chatId = $request->getChatId();

        $chat = $this->chatRepository->getChatById($chatId, $currentUserId);

        if (!$chat) {
            throw new ChatNotFoundException();
        }

        return new GetChatByIdResponse($chat);
    }
}
