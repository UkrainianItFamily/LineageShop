<?php

declare(strict_types=1);

namespace App\Actions\Order;

use Auth;
use App\Exceptions\Order\OrderNotFoundException;
use App\Exceptions\User\UserNotAuthorizedException;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Exceptions\Order\OrderNotBelongCurrentUserException;

final class GetOrderByIdAction
{
    private OrderRepositoryInterface $orderRepositoryInterface;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    public function execute(GetOrderByIdRequest $request): GetOrderByIdResponse
    {
        if (!Auth::id()) {
            throw new UserNotAuthorizedException();
        }

        $order = $this->orderRepositoryInterface->getById($request->getOrderId());

        if (!$order) {
            throw new OrderNotFoundException();
        } elseif ($order->getUserCustomerId() !== Auth::id()) {
            throw new OrderNotBelongCurrentUserException();
        }

        return new GetOrderByIdResponse($order);
    }
}
