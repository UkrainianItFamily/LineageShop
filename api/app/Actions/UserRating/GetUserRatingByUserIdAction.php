<?php

declare(strict_types=1);

namespace App\Actions\UserRating;

use Auth;
use App\Exceptions\User\UserNotFoundException;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserRating\Criterion\UserIdCriterion;
use App\Repositories\UserRating\UserRatingRepositoryInterface;

final class GetUserRatingByUserIdAction
{
    private UserRatingRepositoryInterface $userRatingRepositoryInterface;
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(
        UserRatingRepositoryInterface $userRatingRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->userRatingRepositoryInterface = $userRatingRepositoryInterface;
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(GetUserRatingByUserIdRequest $request): GetUserRatingByUserIdResponse
    {
        if ($request->getUserId()) {
            $user = $this->userRepositoryInterface->getById($request->getUserId());
            if (!$user) {
                throw new UserNotFoundException();
            }

            $userId = $user->getId();
        } else {
            $userId = Auth::id();
        }

        $criteria[] = new UserIdCriterion($userId);

        $userRatings = $this->userRatingRepositoryInterface->findByCriteria($criteria);

        return new GetUserRatingByUserIdResponse($userRatings);
    }
}
