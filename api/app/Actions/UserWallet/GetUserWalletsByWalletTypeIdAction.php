<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

use Auth;
use App\Repositories\Product\Criterion\UserIdCriterion;
use App\Repositories\UserWallet\UserWalletRepositoryInterface;
use App\Repositories\UserWallet\Criterion\WalletTypeIdCriterion;

final class GetUserWalletsByWalletTypeIdAction
{
    private UserWalletRepositoryInterface $userWalletRepository;

    public function __construct(UserWalletRepositoryInterface $userWalletRepository)
    {
        $this->userWalletRepository = $userWalletRepository;
    }

    public function execute(GetUserWalletsByWalletTypeIdRequest $request): GetUserWalletsByWalletTypeIdResponse
    {
        $criteria[] = new UserIdCriterion(Auth::id());

        if ($request->getWalletTypeId()) {
            $criteria[] = new WalletTypeIdCriterion($request->getWalletTypeId());
        }

        $userWallets = $this->userWalletRepository->findByCriteria($criteria);


        return new GetUserWalletsByWalletTypeIdResponse($userWallets);
    }
}
