<?php

namespace App\Http\Presenters\UserWallet;

use App\Models\UserWallet;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;
use App\Http\Presenters\WalletType\WalletTypeAsArrayPresenter;

class UserWalletAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private WalletTypeAsArrayPresenter $walletTypeAsArrayPresenter;

    public function __construct(WalletTypeAsArrayPresenter $walletTypeAsArrayPresenter)
    {
        $this->walletTypeAsArrayPresenter = $walletTypeAsArrayPresenter;
    }

    public function present(UserWallet $userWallet): array
    {
        (array) $arrayUserWallet = [
            'id' => $userWallet->getId(),
            'info' => $userWallet->getInfo(),
            'type' => $this->walletTypeAsArrayPresenter->present($userWallet->walletType),
        ];

        return $arrayUserWallet;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (UserWallet  $userWallet) {
                    return $this->present($userWallet);
                }
            )
            ->all();
    }
}
