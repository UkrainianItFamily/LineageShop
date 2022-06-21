<?php

namespace App\Http\Presenters\SupportRequestMessage;

use App\Http\Presenters\User\UserArrayPresenter;
use App\Models\SupportRequestMessage;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

class SupportRequestMessagesAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private UserArrayPresenter $userArrayPresenter;

    public function __construct(UserArrayPresenter $userArrayPresenter)
    {
        $this->userArrayPresenter = $userArrayPresenter;
    }

    public function present(SupportRequestMessage $supportRequestMessage): array
    {
        $arrayResponse = [
            'id' => $supportRequestMessage->getId(),
            'text' => $supportRequestMessage->getText(),
            'user' =>  $this->userArrayPresenter->present($supportRequestMessage->user),
            'createdAt' => Carbon::now()->diffForHumans($supportRequestMessage->getCreatedAt())
        ];
        return $arrayResponse;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (SupportRequestMessage $supportRequestMessage) {
                    return $this->present($supportRequestMessage);
                }
            )
            ->all();
    }
}
