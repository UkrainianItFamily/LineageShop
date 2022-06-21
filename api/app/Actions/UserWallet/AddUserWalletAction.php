<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

use Auth;
use App\Models\UserWallet;
use App\Repositories\UserWallet\UserWalletRepository;

final class AddUserWalletAction
{
    private UserWalletRepository $userWalletRepository;

    public function __construct(UserWalletRepository $userWalletRepository)
    {
        $this->userWalletRepository = $userWalletRepository;
    }

    public function execute(AddUserWalletRequest $request): AddUserWalletResponse
    {
        $newUserWallet = new UserWallet();

        $newUserWallet->info = $request->getInfo();
        $newUserWallet->wallet_type_id = $request->getWalletTypeId();
        $newUserWallet->user_id = Auth::id();

        $newUserWallet = $this->userWalletRepository->save($newUserWallet);

        return new AddUserWalletResponse($newUserWallet);
    }
}
