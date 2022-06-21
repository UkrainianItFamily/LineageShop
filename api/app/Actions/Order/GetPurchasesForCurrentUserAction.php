<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Repositories\Order\Criterion\OrderByIdCriterion;
use App\Repositories\Order\Criterion\OrdersByCustomerIdCriterion;
use App\Repositories\Order\Criterion\OrdersByStatusCriterion;
use App\Repositories\Order\Criterion\OrdersByUserSellerLoginCriterion;
use Auth;
use App\Repositories\Order\OrderRepository;

final class GetPurchasesForCurrentUserAction
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(GetPurchasesForCurrentUserRequest $request): GetPurchasesForCurrentUserResponse
    {
        $criteria = [];

        $criteria[] = new OrdersByCustomerIdCriterion(Auth::id());

        if($request->getStatusId()) {
            $criteria[] = new OrdersByStatusCriterion($request->getStatusId());
        }

        if($request->getPurchaseId()) {
            $criteria[] = new OrderByIdCriterion($request->getPurchaseId());
        }

        if($request->getSellerLogin()) {
            $criteria[] = new OrdersByUserSellerLoginCriterion($request->getSellerLogin());
        }

        $orders = $this->orderRepository->findByCriteria($criteria);

        return new GetPurchasesForCurrentUserResponse($orders);
    }
}
