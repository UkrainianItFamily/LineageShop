<?php

namespace App\Http\Presenters\Message;

use App\Http\Presenters\User\UserAsArrayForProductPresenter;
use App\Models\Message;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

class MessageAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private UserAsArrayForProductPresenter $userAsArrayForProductPresenter;

    public function __construct(UserAsArrayForProductPresenter $userAsArrayForProductPresenter)
    {
        $this->userAsArrayForProductPresenter = $userAsArrayForProductPresenter;
    }

    public function present(Message $message): array
    {
        (array) $arrayMessage = [
            'id' => $message->getId(),
            'message' => $message->getMessage(),
            'attachment' => $message->getAttachment(),
            'authorUser' => $this->userAsArrayForProductPresenter->present($message->author),
            'hiddenStatus' => $message->getHiddenStatus(),
            'createdAt' => $message->getCreatedAt(),
        ];

        return $arrayMessage;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Message $message) {
                    return $this->present($message);
                }
            )
            ->all();
    }
}
