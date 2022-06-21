<?php

namespace App\Jobs\Order;

use App\Constant\OrderConstant;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckOrderStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle(OrderRepositoryInterface $orderRepository)
    {
        $order = $orderRepository->getById($this->orderId);

        $orderStatus = $order->getStatus();

        if($orderStatus !== OrderConstant::CONFIRMED) {
            $order->status = OrderConstant::CANCELED;
        }

        $orderRepository->update($order);
    }
}
