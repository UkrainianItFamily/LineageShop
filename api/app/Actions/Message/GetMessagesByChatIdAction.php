<?php

declare(strict_types=1);

namespace App\Actions\Message;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\User\UserNotAuthorizedException;
use App\Repositories\Message\MessageRepositoryInterface;

final class GetMessagesByChatIdAction
{
    private MessageRepositoryInterface $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function execute(GetMessagesByChatIdRequest $request): GetMessagesByChatIdResponse
    {
        if (!Auth::id()) {
            throw new UserNotAuthorizedException();
        }

        $currentUserId = Auth::id();
        $chatId = $request->getChatId();

        $messages = $this->messageRepository->getMessagesByChatId($chatId, $currentUserId);

        return new GetMessagesByChatIdResponse($messages);
    }
}
