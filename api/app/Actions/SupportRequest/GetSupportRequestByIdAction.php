<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

use App\Constant\SupportRequestConstant;
use App\Repositories\SupportRequest\SupportRequestRepositoryInterface;

final class GetSupportRequestByIdAction
{
    private SupportRequestRepositoryInterface $supportRepository;

    public function __construct(SupportRequestRepositoryInterface $supportRepository)
    {
        $this->supportRepository = $supportRepository;
    }

    public function execute(GetSupportRequestByIdRequest $request): GetSupportRequestByIdResponse
    {
        $supportRequests = $this->supportRepository->getSupportRequestById($request->getSupportRequestId());
        $this->supportRepository->updateSupportStatus(
            $supportRequests->getId(),
            SupportRequestConstant::READ
        );

        return new GetSupportRequestByIdResponse($supportRequests);
    }
}
