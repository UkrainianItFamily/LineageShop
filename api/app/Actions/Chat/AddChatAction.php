<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Chat\ChatRepositoryInterface;
use App\Exceptions\Chat\ChatAlreadyCreatedException;

final class AddChatAction
{
    private ChatRepositoryInterface $chatRepository;

    public function __construct(ChatRepositoryInterface $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function execute(AddChatRequest $request): AddChatResponse
    {
        $authorUserId = Auth::id();
        $recipientUserId = $request->getRecipientUserId();

        if ($this->chatRepository->getChatByUsers($authorUserId, $recipientUserId)) {
            throw new ChatAlreadyCreatedException();
        }

        $chat = new Chat();
        $chat->first_user_id = $authorUserId;
        $chat->second_user_id = $recipientUserId;

        $chat = $this->chatRepository->save($chat);

        return new AddChatResponse($chat);
    }
}
