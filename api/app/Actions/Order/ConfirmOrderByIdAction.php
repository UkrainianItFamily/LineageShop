<?php

declare(strict_types=1);

namespace App\Actions\Order;

use Auth;
use App\Constant\OrderConstant;
use App\Exceptions\User\UserNotAuthorizedException;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Exceptions\Order\OrderNotBelongCurrentUserException;

final class ConfirmOrderByIdAction
{
    private OrderRepositoryInterface $orderRepositoryInterface;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    public function execute(GetOrderByIdRequest $request): ConfirmOrderByIdResponse
    {
        if (!Auth::id()) {
            throw new UserNotAuthorizedException();
        }

        $order = $this->orderRepositoryInterface->getById($request->getOrderId());

        if ($order->getUserCustomerId() !== Auth::id()) {
            throw new OrderNotBelongCurrentUserException();
        }

        $order->status = OrderConstant::CONFIRMED;

        $order = $this->orderRepositoryInterface->update($order);

        return new ConfirmOrderByIdResponse($order);
    }
}
