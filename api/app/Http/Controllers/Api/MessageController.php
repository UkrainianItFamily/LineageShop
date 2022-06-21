<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Actions\Message\AddMessageAction;
use App\Actions\Message\AddMessageRequest;
use App\Actions\Message\GetMessagesByChatIdAction;
use App\Actions\Message\GetMessagesByChatIdRequest;
use App\Http\Presenters\Message\MessageAsArrayPresenter;
use App\Http\Requests\Message\MessageCreateValidationRequest;

class MessageController extends ApiController
{
    public function addMessage(
        MessageCreateValidationRequest $request,
        AddMessageAction $addMessageAction
    ): JsonResponse {
        $addMessageAction->execute(
            new AddMessageRequest(
                $request->input('message'),
                $request->input('chatId')
            )
        );

        return $this->successResponse(['msg' => 'OK'], JsonResponse::HTTP_OK);
    }

    public function getMessagesByChatId(
        MessageAsArrayPresenter $messageAsArrayPresenter,
        GetMessagesByChatIdAction $getMessagesByChatIdAction,
        string $chatId
    ): JsonResponse {
        $messages = $getMessagesByChatIdAction->execute(
            new GetMessagesByChatIdRequest(
                (int) $chatId,
            )
        );

        $presenter = $messageAsArrayPresenter->presentCollection($messages->getResponse());

        return $this->successResponse($presenter);
    }
}
