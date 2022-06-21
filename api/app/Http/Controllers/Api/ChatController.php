<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Actions\Chat\AddChatAction;
use App\Actions\Chat\AddChatRequest;
use App\Actions\Chat\GetChatByIdAction;
use App\Actions\Chat\GetChatByIdRequest;
use App\Actions\Chat\GetChatByUserIdAction;
use App\Actions\Chat\GetChatByUserIdRequest;
use App\Actions\Chat\GetChatsByCurrentUserAction;
use App\Http\Presenters\Chat\ChatAsArrayPresenter;
use App\Http\Requests\Chat\ChatCreateValidationRequest;

class ChatController extends ApiController
{
    public function create(
        ChatCreateValidationRequest $request,
        AddChatAction $addChatAction,
        ChatAsArrayPresenter $chatAsArrayPresenter
    ): JsonResponse {
        $chat = $addChatAction->execute(
            new AddChatRequest(
                (int) $request->input('recipientUserId'),
            )
        );

        $presenter = $chatAsArrayPresenter->present($chat->getResponse());

        return $this->successResponse($presenter);
    }

    public function getChatsByCurrentUser(
        ChatAsArrayPresenter $chatAsArrayPresenter,
        GetChatsByCurrentUserAction $getChatsByCurrentUserAction
    ): JsonResponse {
        $chats = $getChatsByCurrentUserAction->execute();

        $presenter = $chatAsArrayPresenter->presentCollection($chats->getResponse());

        return $this->successResponse($presenter);
    }

    public function getChatByUserId(
        GetChatByUserIdAction $getChatByUserIdAction,
        ChatAsArrayPresenter $chatAsArrayPresenter,
        string $userId
    ): JsonResponse {
        $chat = $getChatByUserIdAction
            ->execute(new GetChatByUserIdRequest((int) $userId))
            ->getResponse();

        $presenter = $chatAsArrayPresenter->present($chat);

        return $this->successResponse($presenter);
    }

    public function getChatById(
        ChatAsArrayPresenter $chatAsArrayPresenter,
        GetChatByIdAction $getChatByIdAction,
        string $chatId
    ): JsonResponse {
        $chats = $getChatByIdAction->execute(
            new GetChatByIdRequest((int) $chatId)
        );

        $presenter = $chatAsArrayPresenter->present($chats->getResponse());

        return $this->successResponse($presenter);
    }
}
