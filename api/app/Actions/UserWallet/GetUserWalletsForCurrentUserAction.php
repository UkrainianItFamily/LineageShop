<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

use Auth;
use App\Repositories\UserWallet\Criterion\UserIdCriterion;
use App\Repositories\UserWallet\UserWalletRepositoryInterface;

final class GetUserWalletsForCurrentUserAction
{
    private UserWalletRepositoryInterface $userWalletRepositoryInterface;

    public function __construct(UserWalletRepositoryInterface $userWalletRepositoryInterface)
    {
        $this->userWalletRepositoryInterface = $userWalletRepositoryInterface;
    }

    public function execute(): GetUserWalletsForCurrentUserResponse
    {
        $criteria[] = new UserIdCriterion(Auth::id());

        $userWallets = $this->userWalletRepositoryInterface->findByCriteria($criteria);

        return new GetUserWalletsForCurrentUserResponse($userWallets);
    }
}
