<?php

namespace App\Http\Presenters\FinanceOperation;

use Illuminate\Support\Collection;
use App\Models\FinanceOperationsHistory;
use App\Http\Presenters\User\UserArrayPresenter;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;
use App\Http\Presenters\UserWallet\UserWalletAsArrayWithMaskPresenter;

class FinanceOperationAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private UserWalletAsArrayWithMaskPresenter $userWalletAsArrayWithMaskPresenter;
    private UserArrayPresenter $userArrayPresenter;

    public function __construct(
        UserWalletAsArrayWithMaskPresenter $userWalletAsArrayWithMaskPresenter,
        UserArrayPresenter $userArrayPresenter
    ) {
        $this->userWalletAsArrayWithMaskPresenter = $userWalletAsArrayWithMaskPresenter;
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
                ? $this->userWalletAsArrayWithMaskPresenter->present($financeOperation->userWallet)
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
