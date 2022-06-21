<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

use App\Actions\SupportRequestMessage\GetSupportRequestResponse;
use App\Constant\SupportRequestConstant;
use App\Exceptions\SupportRequest\OrderNumberNotFoundException;
use App\Models\SupportRequest;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\SupportRequest\SupportRequestRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class SendSupportRequestAction
{
    public SupportRequestRepositoryInterface $supportRequestRepositoryInterface;
    public OrderRepositoryInterface $orderRepository;

    public function __construct(SupportRequestRepositoryInterface $supportRequestRepositoryInterface, OrderRepositoryInterface $orderRepository)
    {
        $this->supportRequestRepositoryInterface = $supportRequestRepositoryInterface;
        $this->orderRepository = $orderRepository;
    }

    public function execute(SendSupportRequest $request): GetSupportRequestResponse
    {
        $newSupportRequest = new SupportRequest();

        $newSupportRequest->text = $request->getText();
        $newSupportRequest->subject = $request->getSubject();
        $newSupportRequest->order_id = $request->getOrderId();
        $newSupportRequest->login = $request->getLogin();
        $newSupportRequest->author_id = Auth::id();
        $newSupportRequest->status = SupportRequestConstant::OPEN;
        $newSupportRequest->status = $request->getEmail();

        if($request->getOrderId()) {
            $order = $this->orderRepository->getById($request->getOrderId());
            if(!$order) {
                throw new OrderNumberNotFoundException();
            } else {
                $newSupportRequest->order_id = $request->getOrderId();
            }
        }

        $this->supportRequestRepositoryInterface->save($newSupportRequest);

        $newSupportRequest->sendSupportRequest($newSupportRequest);

        return new GetSupportRequestResponse($newSupportRequest);
    }
}
