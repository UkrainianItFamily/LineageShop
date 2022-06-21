<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Repositories\Order\OrderRepositoryInterface;

final class ChangeOrderStatusAction
{
    private OrderRepositoryInterface $orderRepositoryInterface;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    public function execute(ChangeOrderStatusRequest $request): ChangeOrderStatusResponse
    {
        $order = $this->orderRepositoryInterface->getById($request->getId());

        $order->status = $request->getStatus();

        $updatedOrder = $this->orderRepositoryInterface->update($order);

        return new ChangeOrderStatusResponse($updatedOrder);
    }
}
