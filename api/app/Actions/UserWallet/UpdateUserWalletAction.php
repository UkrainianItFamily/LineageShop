<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

use Auth;
use App\Exceptions\UserWallet\UserWalletNotFoundException;
use App\Repositories\UserWallet\UserWalletRepositoryInterface;
use App\Exceptions\UserWallet\WalletNotBelongToCurrentUserException;

final class UpdateUserWalletAction
{
    private UserWalletRepositoryInterface $userWalletRepositoryInterface;

    public function __construct(UserWalletRepositoryInterface $userWalletRepositoryInterface)
    {
        $this->userWalletRepositoryInterface = $userWalletRepositoryInterface;
    }

    public function execute(UpdateUserWalletRequest $request): UpdateUserWalletResponse
    {
        $updateUserWallet = $this->userWalletRepositoryInterface->getById($request->getId());

        if (!$updateUserWallet) {
            throw new UserWalletNotFoundException();
        }

        if ($updateUserWallet->getUserId() !== Auth::id()) {
            throw new WalletNotBelongToCurrentUserException();
        }

        $updateUserWallet->info = $request->getInfo();
        $updateUserWallet->wallet_type_id = $request->getWalletTypeId();

        $updatedUserWallet = $this->userWalletRepositoryInterface->update($updateUserWallet);

        return new UpdateUserWalletResponse($updatedUserWallet);
    }
}
