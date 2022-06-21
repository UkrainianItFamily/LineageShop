<?php

namespace App\Http\Presenters\Order;

use App\Models\Order;
use Illuminate\Support\Collection;
use App\Http\Presenters\User\UserArrayPresenter;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;
use App\Http\Presenters\Product\ProductArrayForOrderPresenter;
use App\Http\Presenters\WalletType\WalletTypeAsArrayPresenter;

class OrderAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    private ProductArrayForOrderPresenter $productArrayForOrderPresenter;
    private UserArrayPresenter $userArrayPresenter;
    private WalletTypeAsArrayPresenter $walletTypeAsArrayPresenter;

    public function __construct(
        ProductArrayForOrderPresenter $productArrayForOrderPresenter,
        WalletTypeAsArrayPresenter $walletTypeAsArrayPresenter,
        UserArrayPresenter $userArrayPresenter
    ) {
        $this->productArrayForOrderPresenter = $productArrayForOrderPresenter;
        $this->walletTypeAsArrayPresenter = $walletTypeAsArrayPresenter;
        $this->userArrayPresenter = $userArrayPresenter;
    }

    public function present(Order $order): array
    {
        (array) $arrayOrder = [
            'id' => $order->getId(),
            'product' => $this->productArrayForOrderPresenter->present($order->product),
            'userCustomer' => $this->userArrayPresenter->present($order->userCustomer),
            'userSeller' => $this->userArrayPresenter->present($order->userSeller),
            'walletType' => $this->walletTypeAsArrayPresenter->present($order->walletType),
            'shipType' => $order->getShipType(),
            'status' => $order->getStatus(),
            'nickname' => $order->getNickname(),
            'quantity' => $order->getQuantity(),
            'orderPrice' => $order->getOrderPrice(),
            'dateOpen' => $order->getDateOpen(),
            'dateClose' => $order->getDateClose(),
        ];

        return $arrayOrder;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Order $order) {
                    return $this->present($order);
                }
            )
            ->all();
    }
}
