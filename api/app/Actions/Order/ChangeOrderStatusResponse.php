<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Models\Order;
use App\Actions\Response;

final class ChangeOrderStatusResponse implements Response
{
    private Order $updatedOrder;

    public function __construct(Order $updatedOrder)
    {
        $this->updatedOrder = $updatedOrder;
    }

    public function getResponse(): Order
    {
        return $this->updatedOrder;
    }
}
