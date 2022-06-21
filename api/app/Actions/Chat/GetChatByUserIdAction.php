<?php

declare(strict_types=1);

namespace App\Actions\Chat;

use Auth;
use App\Exceptions\User\UserNotFoundException;
use App\Repositories\Chat\ChatRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

final class GetChatByUserIdAction
{
    private ChatRepositoryInterface $chatRepositoryInterface;
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(
        ChatRepositoryInterface $chatRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->chatRepositoryInterface = $chatRepositoryInterface;
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(GetChatByUserIdRequest $request): GetChatByUserIdResponse
    {
        $secondUser = $this->userRepositoryInterface->getById($request->getSecondUserId());

        if (!$secondUser) {
            throw new UserNotFoundException();
        }

        $chat = $this->chatRepositoryInterface->getChatByUsers(Auth::id(), $secondUser->getId());

        return new GetChatByUserIdResponse($chat);
    }
}
