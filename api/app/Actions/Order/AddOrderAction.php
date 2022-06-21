<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Exceptions\Order\RequestLimitExceeded;
use App\Repositories\Product\ProductRepositoryInterface;
use Auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Constant\OrderConstant;
use App\Repositories\Order\OrderRepositoryInterface;

final class AddOrderAction
{
    private OrderRepositoryInterface $orderRepositoryInterface;
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(
        OrderRepositoryInterface $orderRepositoryInterface,
        ProductRepositoryInterface $productRepositoryInterface
    ) {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function execute(AddOrderRequest $request): AddOrderResponse
    {
        $productAvailability = $this
            ->productRepositoryInterface
            ->getProductAvailabilityColumn($request->getProductId())
            ->getAvailability();

        if($request->getQuantity() > $productAvailability) {
            throw new RequestLimitExceeded();
        }

        $newOrder = new Order;

        $newOrder->product_id = $request->getProductId();
        $newOrder->user_customer_id = Auth::id();
        $newOrder->user_seller_id = $request->getUserSellerId();
        $newOrder->wallet_type_id = $request->getWalletTypeId();
        $newOrder->ship_type = OrderConstant::BANK_CARD;
        $newOrder->status = OrderConstant::CREATED;
        $newOrder->nickname = $request->getNickname();
        $newOrder->date_open = Carbon::now()->format('Y-m-d h:i:s');
        $newOrder->order_price = $request->getQuantity()
            ? round(($request->getQuantity() * $newOrder->product->getPrice()), 2)
            : $newOrder->product->getPrice();
        if ($request->getQuantity()) {
            $newOrder->quantity = $request->getQuantity();
        }

        $this->orderRepositoryInterface->save($newOrder);

        return new AddOrderResponse($newOrder);
    }
}
