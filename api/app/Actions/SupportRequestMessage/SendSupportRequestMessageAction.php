<?php

declare(strict_types=1);

namespace App\Actions\SupportRequestMessage;

use App\Constant\SupportRequestConstant;
use App\Models\SupportRequestMessage;
use App\Repositories\SupportRequest\SupportRequestRepositoryInterface;
use App\Repositories\SupportRequestMessage\SupportRequestMessageRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class SendSupportRequestMessageAction
{
    public SupportRequestMessageRepositoryInterface $supportRequestMessageRepository;
    public SupportRequestRepositoryInterface  $supportRequestRepository;
    public UserRepositoryInterface $userRepository;

    public function __construct(
        SupportRequestMessageRepositoryInterface $supportRequestMessageRepository,
        SupportRequestRepositoryInterface  $supportRequestRepository,
        UserRepositoryInterface $userRepository)
    {
        $this->supportRequestMessageRepository = $supportRequestMessageRepository;
        $this->supportRequestRepository = $supportRequestRepository;
        $this->userRepository = $userRepository;
    }

    public function execute(SendSupportRequestMessageRequest $request): GetSupportRequestMessageResponse
    {
        $newSupportRequestMessage = new SupportRequestMessage();

        $newSupportRequestMessage->text = $request->getText();
        $newSupportRequestMessage->user_id = Auth::id();
        $newSupportRequestMessage->support_request_id = $request->getSupportRequestId();

        $this->supportRequestMessageRepository->save($newSupportRequestMessage);
        $this->supportRequestRepository->updateSupportStatus(
            $request->getSupportRequestId(),
            SupportRequestConstant::UNREAD);

        if($request->getSupportRequestAuthorId()) {
            $supportAuthor = $this->userRepository->getById($request->getSupportRequestAuthorId());

            if(Auth::id() === $supportAuthor->getId()) {
                $mailFromAddress = $supportAuthor->getEmail();
                $mailToAddress = SupportRequestConstant::SUPPORT_EMAIL;
            } else {
                $mailFromAddress = SupportRequestConstant::SUPPORT_EMAIL;
                $mailToAddress = $supportAuthor->getEmail();
            }

            $newSupportRequestMessage->sendSupportRequestNewMessage(
                $newSupportRequestMessage,
                $mailToAddress,
                $mailFromAddress,
                $request->getSupportRequestId(),
                $request->getSupportRequestSubjectId()
            );
        }

        return new GetSupportRequestMessageResponse($newSupportRequestMessage);
    }
}
