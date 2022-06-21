<?php

namespace App\Http\Presenters\FinanceOperation;

use App\Http\Presenters\UserWallet\UserWalletAsArrayPresenter;
use Illuminate\Support\Collection;
use App\Models\FinanceOperationsHistory;
use App\Http\Presenters\User\UserArrayPresenter;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

class FinanceOperationAsArrayWithoutWalletMaskPresenter implements CollectionAsArrayPresenterInterface
{
    private UserWalletAsArrayPresenter $userWalletAsArrayPresenter;
    private UserArrayPresenter $userArrayPresenter;

    public function __construct(
        UserWalletAsArrayPresenter $userWalletAsArrayPresenter,
        UserArrayPresenter $userArrayPresenter
    ) {
        $this->userWalletAsArrayPresenter = $userWalletAsArrayPresenter;
        $this->userArrayPresenter = $userArrayPresenter;
    }

    public function present(FinanceOperationsHistory $financeOperation): array
    {
        (array) $arrayFinanceOperation = [
            'id' => $financeOperation->getId(),
            'money' => $financeOperation->getMoney(),
            'type' => $financeOperation->getType(),
            'status' => $financeOperation->getStatus(),
            'user' => $this->userArrayPresenter->present($financeOperation->user),
            'wallet' => $financeOperation->userWallet
                ? $this->userWalletAsArrayPresenter->present($financeOperation->userWallet)
                : null,
            'createdAt' => $financeOperation->getCreatedAt(),
            'canceledAt' => $financeOperation->getCanceledAt(),
            'canceledInfo' => $financeOperation->getCanceledInfo(),
        ];

        return $arrayFinanceOperation;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (FinanceOperationsHistory  $financeOperation) {
                    return $this->present($financeOperation);
                }
            )
            ->all();
    }
}
