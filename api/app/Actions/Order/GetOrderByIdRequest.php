<?php

declare(strict_types=1);

namespace App\Actions\Order;

final class GetOrderByIdRequest
{
    private int $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }
}
