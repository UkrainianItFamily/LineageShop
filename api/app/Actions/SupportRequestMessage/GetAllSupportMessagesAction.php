<?php

declare(strict_types=1);

namespace App\Actions\SupportRequestMessage;


use App\Repositories\SupportRequestMessage\SupportRequestMessageRepositoryInterface;

final class GetAllSupportMessagesAction
{
    private SupportRequestMessageRepositoryInterface $supportMessageRepository;

    public function __construct(SupportRequestMessageRepositoryInterface $supportMessageRepository)
    {
        $this->supportMessageRepository = $supportMessageRepository;
    }

    public function execute(GetSupportRequestMessages $supportRequestMessage): GetAllSupportMessagesResponse
    {
        $supportMessagesCollection = $this->supportMessageRepository->getAllBySupportRequestId($supportRequestMessage->getId());

        return new GetAllSupportMessagesResponse($supportMessagesCollection);
    }
}
