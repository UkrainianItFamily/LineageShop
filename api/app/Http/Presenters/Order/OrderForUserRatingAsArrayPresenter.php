<?php

namespace App\Http\Presenters\Order;

use App\Models\Order;

class OrderForUserRatingAsArrayPresenter
{
    public function present(Order $order): array
    {
        (array) $arrayOrder = [
            'id' => $order->getId(),
            'productPrice' => $order->product->getPrice(),
            'shipType' => $order->getShipType(),
            'status' => $order->getStatus(),
            'dateOpen' => $order->getDateOpen(),
            'dateClose' => $order->getDateClose(),
        ];

        return $arrayOrder;
    }
}
