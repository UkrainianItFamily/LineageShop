<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Actions\Response;
use App\Models\Order;

final class GetOrderByIdResponse implements Response
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getResponse(): Order
    {
        return $this->order;
    }
}
