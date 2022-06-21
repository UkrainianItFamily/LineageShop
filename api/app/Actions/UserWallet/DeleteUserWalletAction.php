<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

use Auth;
use App\Exceptions\UserWallet\UserWalletNotFoundException;
use App\Repositories\UserWallet\UserWalletRepositoryInterface;
use App\Exceptions\UserWallet\WalletNotBelongToCurrentUserException;

final class DeleteUserWalletAction
{
    private UserWalletRepositoryInterface $userWalletRepositoryInterface;

    public function __construct(UserWalletRepositoryInterface $userWalletRepositoryInterface)
    {
        $this->userWalletRepositoryInterface = $userWalletRepositoryInterface;
    }

    public function execute(DeleteUserWalletRequest $request): void
    {
        $userWallet = $this->userWalletRepositoryInterface->getById($request->getId());

        if (!$userWallet) {
            throw new UserWalletNotFoundException();
        }

        if ($userWallet->getUserId() !== Auth::id()) {
            throw new WalletNotBelongToCurrentUserException();
        }

        $this->userWalletRepositoryInterface->delete($userWallet);
    }
}
