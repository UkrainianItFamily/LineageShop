<?php

declare(strict_types=1);

namespace App\Actions\Message;

use App\Models\Message;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\User\UserNotAuthorizedException;
use App\Repositories\Message\MessageRepositoryInterface;

final class AddMessageAction
{
    private MessageRepositoryInterface $messageRepository;

    private Mailer $mailer;

    public function __construct(MessageRepositoryInterface $messageRepository, Mailer $mailer)
    {
        $this->messageRepository = $messageRepository;
        $this->mailer = $mailer;
    }

    public function execute(AddMessageRequest $request): void
    {
        if (!Auth::id()) {
            throw new UserNotAuthorizedException();
        }

        $authorUserId = Auth::id();

        $message = new Message();
        $message->message = $request->getMessage();
        $message->chat_id = $request->getChatId();
        $message->author_user_id = $authorUserId;

        $message = $this->messageRepository->save($message);

        $message->sendNewMessageNotification($message);
    }
}
