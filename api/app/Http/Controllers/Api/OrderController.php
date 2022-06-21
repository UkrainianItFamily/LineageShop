<?php

namespace App\Http\Controllers\Api;

use App\Actions\FinanceOperation\AddEnrollmentFinanceOperationAction;
use App\Actions\FinanceOperation\AddEnrollmentFinanceOperationRequest;
use App\Actions\FinanceOperation\AddWriteOffsFinanceOperationAction;
use App\Actions\FinanceOperation\AddWriteOffsFinanceOperationRequest;
use App\Actions\Order\GetPurchasesForCurrentUserRequest;
use App\Actions\Order\GetSalesForCurrentUserRequest;
use App\Http\Requests\Order\GetOrdersByCriteriaValidationRequest;
use App\Jobs\Order\CheckOrderStatusJob;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\Order\AddOrderAction;
use App\Actions\Order\AddOrderRequest;
use App\Actions\Order\GetAllOrdersAction;
use App\Actions\Order\GetAllOrdersRequest;
use App\Actions\Order\ChangeOrderStatusAction;
use App\Actions\Order\ChangeOrderStatusRequest;
use App\Actions\Order\GetOrderByIdAction;
use App\Actions\Order\GetOrderByIdRequest;
use App\Actions\Order\ConfirmOrderByIdAction;
use App\Actions\Order\GetSalesForCurrentUserAction;
use App\Http\Presenters\Order\OrderAsArrayPresenter;
use App\Actions\Order\GetPurchasesForCurrentUserAction;
use App\Http\Requests\Order\ConfirmOrderValidatorRequest;
use App\Http\Requests\Order\CreateOrderValidationRequest;
use App\Http\Requests\Order\ChangeOrderStatusValidationRequest;

class OrderController extends ApiController
{
    public function getAllOrders(
        GetAllOrdersAction $getAllOrdersAction,
        OrderAsArrayPresenter $orderAsArrayPresenter,
        Request $request
    ): JsonResponse {
        $orders = $getAllOrdersAction
            ->execute(new GetAllOrdersRequest(
                (int) $request->input('id'),
                $request->input('userCustomerLogin'),
                $request->input('userSellerLogin'),
            ))
            ->getResponse();

        $presenter = $orderAsArrayPresenter->presentCollection($orders);

        return $this->successResponse($presenter);
    }

    public function getOrderById(
        GetOrderByIdAction $getOrderByIdAction,
        OrderAsArrayPresenter $orderAsArrayPresenter,
        string $orderId
    ): JsonResponse {
        $order = $getOrderByIdAction
            ->execute(new GetOrderByIdRequest((int) $orderId))
            ->getResponse();

        $presenter = $orderAsArrayPresenter->present($order);

        return $this->successResponse($presenter);
    }

    public function confirmOrderById(
        ConfirmOrderByIdAction $confirmOrderByIdAction,
        OrderAsArrayPresenter $orderAsArrayPresenter,
        AddEnrollmentFinanceOperationAction $addEnrollmentFinanceOperationAction,
        AddWriteOffsFinanceOperationAction $addWriteOffsFinanceOperationAction,
        ConfirmOrderValidatorRequest $request
    ): JsonResponse {
        $writeOffsFinance = $addWriteOffsFinanceOperationAction->execute(
            new AddWriteOffsFinanceOperationRequest(
                $request->input('orderPrice')
            )
        )->getResponse();

        $order = $confirmOrderByIdAction
            ->execute(new GetOrderByIdRequest($request->input('orderId')))
            ->getResponse();

        $enrollmentFinance = $addEnrollmentFinanceOperationAction->execute(
            new AddEnrollmentFinanceOperationRequest(
                $order->getOrderPrice(),
                $order->getUserSellerId()
            )
        )->getResponse();

        $presenter = $orderAsArrayPresenter->present($order);

        return $this->successResponse($presenter);
    }
    public function create(
        AddOrderAction $addOrderAction,
        OrderAsArrayPresenter $orderAsArrayPresenter,
        CreateOrderValidationRequest $request
    ): JsonResponse {
        $newOrder = $addOrderAction
            ->execute(new AddOrderRequest(
                $request->input('productId'),
                $request->input('userSellerId'),
                $request->input('walletTypeId'),
                $request->input('nickname'),
                $request->input('quantity')
            ))
            ->getResponse();

        CheckOrderStatusJob::dispatch($newOrder->getId())->delay(10);

        $presenter = $orderAsArrayPresenter->present($newOrder);

        return $this->successResponse($presenter);
    }

    public function getPurchasesForCurrentUser(
        GetPurchasesForCurrentUserAction $getPurchasesForCurrentUserAction,
        OrderAsArrayPresenter $orderAsArrayPresenter,
        GetOrdersByCriteriaValidationRequest $request
    ): JsonResponse {
        $orders = $getPurchasesForCurrentUserAction
            ->execute(new GetPurchasesForCurrentUserRequest(
                $request->orderId,
                $request->sellerLogin,
                $request->orderStatus
            ))
            ->getResponse();

        $presenter = $orderAsArrayPresenter->presentCollection($orders);

        return $this->successResponse($presenter);
    }

    public function getSalesForCurrentUser(
        GetSalesForCurrentUserAction $getSalesForCurrentUserAction,
        OrderAsArrayPresenter $orderAsArrayPresenter,
        GetOrdersByCriteriaValidationRequest $request
    ): JsonResponse {
        $orders = $getSalesForCurrentUserAction
            ->execute(new GetSalesForCurrentUserRequest(
                (int) $request->orderId,
                $request->customerLogin,
                (int) $request->orderStatus
            ))
            ->getResponse();

        $presenter = $orderAsArrayPresenter->presentCollection($orders);

        return $this->successResponse($presenter);
    }

    public function changeOrderStatus(
        ChangeOrderStatusAction $changeOrderStatusAction,
        OrderAsArrayPresenter $orderAsArrayPresenter,
        ChangeOrderStatusValidationRequest $request
    ): JsonResponse {
        $updatedOrder = $changeOrderStatusAction
            ->execute(new ChangeOrderStatusRequest(
                $request->input('id'),
                $request->input('status'),
            ))
            ->getResponse();

        $presenter = $orderAsArrayPresenter->present($updatedOrder);

        return $this->successResponse($presenter);
    }
}
