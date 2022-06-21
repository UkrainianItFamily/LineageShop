<?php

namespace App\Http\Presenters\Chat;

use App\Models\Chat;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;
use App\Http\Presenters\User\UserAsArrayForProductPresenter;

class ChatAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private UserAsArrayForProductPresenter $userAsArrayForProductPresenter;

    public function __construct(UserAsArrayForProductPresenter $userAsArrayForProductPresenter)
    {
        $this->userAsArrayForProductPresenter = $userAsArrayForProductPresenter;
    }

    public function present(?Chat $chat): array
    {
        (array) $arrayMessage = [
            'id' => $chat ? $chat->getId() : null,
            'recipientUser' => $chat ? $this->userAsArrayForProductPresenter->present($chat->getRecipientUser) : null,
        ];

        return $arrayMessage;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Chat $chat) {
                    return $this->present($chat);
                }
            )
            ->all();
    }
}
