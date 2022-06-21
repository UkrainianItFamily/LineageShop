<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Actions\UserRating\GetUserRatingByUserIdAction;
use App\Actions\UserRating\GetUserRatingByUserIdRequest;
use App\Http\Presenters\UserRating\UserRatingAsArrayPresenter;

class UserRatingController extends ApiController
{
    public function getUserRatingByUserId(
        GetUserRatingByUserIdAction $getUserRatingByUserIdAction,
        UserRatingAsArrayPresenter $userRatingAsArrayPresenter,
        ?string $userId = null
    ): JsonResponse {
        $userRatings = $getUserRatingByUserIdAction
            ->execute(new GetUserRatingByUserIdRequest(
                (int) $userId
            ))
            ->getResponse();

        $presenter = $userRatingAsArrayPresenter->presentCollection($userRatings);

        return $this->successResponse($presenter);
    }
}
