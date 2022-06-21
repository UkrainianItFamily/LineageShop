<?php

namespace App\Http\Presenters\UserRating;

use App\Models\UserRating;
use Illuminate\Support\Collection;
use App\Http\Presenters\User\UserArrayPresenter;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;
use App\Http\Presenters\Order\OrderForUserRatingAsArrayPresenter;

class UserRatingAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private UserArrayPresenter $userArrayPresenter;
    private OrderForUserRatingAsArrayPresenter $orderForUserRatingAsArrayPresenter;

    public function __construct(
        UserArrayPresenter $userArrayPresenter,
        OrderForUserRatingAsArrayPresenter $orderForUserRatingAsArrayPresenter
    ) {
        $this->userArrayPresenter = $userArrayPresenter;
        $this->orderForUserRatingAsArrayPresenter = $orderForUserRatingAsArrayPresenter;
    }

    public function present(UserRating $userRating): array
    {
        return [
            'id' => $userRating->getId(),
            'userId' => $userRating->getUserId(),
            'userCustomer' => $this->userArrayPresenter->present($userRating->userCustomers),
            'rating' => $userRating->getRating(),
            'text' => $userRating->getText(),
            'order' => $this->orderForUserRatingAsArrayPresenter->present($userRating->order),
            'createdAt' => $userRating->getCreatedAt(),
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (UserRating $userRating) {
                    return $this->present($userRating);
                }
            )
            ->all();
    }
}
