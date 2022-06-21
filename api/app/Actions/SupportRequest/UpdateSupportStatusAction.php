<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

use App\Repositories\SupportRequest\SupportRequestRepositoryInterface;

final class UpdateSupportStatusAction
{
    private SupportRequestRepositoryInterface $supportRepository;

    public function __construct(SupportRequestRepositoryInterface $supportRepository)
    {
        $this->supportRepository = $supportRepository;
    }

    public function execute(UpdateSupportStatusRequest $request): UpdateSupportStatusResponse
    {
        $supportRequest = $this->supportRepository->getSupportRequestById($request->getSupportRequestId());

        $supportRequest->status = $request->getSupportRequestStatusId();

        $supportRequest->update();

        return new UpdateSupportStatusResponse($supportRequest);
    }
}
