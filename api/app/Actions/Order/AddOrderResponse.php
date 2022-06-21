<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Models\Order;
use App\Actions\Response;

final class AddOrderResponse implements Response
{
    private Order $newOrder;

    public function __construct(Order $newOrder)
    {
        $this->newOrder = $newOrder;
    }

    public function getResponse(): Order
    {
        return $this->newOrder;
    }
}
