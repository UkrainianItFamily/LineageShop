<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Repositories\Order\Criterion\OrderByIdCriterion;
use App\Repositories\Order\Criterion\OrdersBySellerIdCriterion;
use App\Repositories\Order\Criterion\OrdersByStatusCriterion;
use App\Repositories\Order\Criterion\OrdersByUserCustomerLoginCriterion;
use Auth;
use App\Repositories\Order\OrderRepository;

final class GetSalesForCurrentUserAction
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(GetSalesForCurrentUserRequest $request): GetSalesForCurrentUserResponse
    {
        $criteria = [];

        $criteria[] = new OrdersBySellerIdCriterion(Auth::id());

        if($request->getStatusId()) {
            $criteria[] = new OrdersByStatusCriterion($request->getStatusId());
        }

        if($request->getSaleId()) {
            $criteria[] = new OrderByIdCriterion($request->getSaleId());
        }

        if($request->getCustomerLogin()) {
            $criteria[] = new OrdersByUserCustomerLoginCriterion($request->getCustomerLogin());
        }

        $orders = $this->orderRepository->findByCriteria($criteria);

        return new GetSalesForCurrentUserResponse($orders);
    }
}
