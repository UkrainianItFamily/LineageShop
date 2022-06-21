<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Order\Criterion\OrderByIdCriterion;
use App\Repositories\Order\Criterion\OrdersByUserSellerLoginCriterion;
use App\Repositories\Order\Criterion\OrdersByUserCustomerLoginCriterion;

final class GetAllOrdersAction
{
    private OrderRepositoryInterface $orderRepositoryInterface;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }

    public function execute(GetAllOrdersRequest $request): GetAllOrdersResponse
    {
        $criteria = [];

        if ($request->getId()) {
            $criteria[] = new OrderByIdCriterion($request->getId());
        }

        if ($request->getUserCustomerLogin()) {
            $criteria[] = new OrdersByUserCustomerLoginCriterion($request->getUserCustomerLogin());
        }

        if ($request->getUserSellerLogin()) {
            $criteria[] = new OrdersByUserSellerLoginCriterion($request->getUserSellerLogin());
        }

        $orders = $this->orderRepositoryInterface->findByCriteria($criteria);

        return new GetAllOrdersResponse($orders);
    }
}
