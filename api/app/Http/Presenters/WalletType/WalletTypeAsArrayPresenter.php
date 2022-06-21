<?php

namespace App\Http\Presenters\WalletType;

use App\Models\WalletType;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

class WalletTypeAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    public function present(WalletType $walletType): array
    {
        (array) $arrayWalletType = [
            'id' => $walletType->getId(),
            'name' => $walletType->getName(),
            'walletSymbol' => $walletType->getWalletSymbol(),
        ];

        return $arrayWalletType;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (WalletType  $walletType) {
                    return $this->present($walletType);
                }
            )
            ->all();
    }
}
