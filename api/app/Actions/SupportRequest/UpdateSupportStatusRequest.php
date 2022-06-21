<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

final class UpdateSupportStatusRequest
{
    private int $requestId;
    private int $requestStatusId;

    public function __construct(
        int $requestId,
        int $requestStatusId
    ) {
        $this->requestId = $requestId;
        $this->requestStatusId = $requestStatusId;
    }

    public function getSupportRequestId(): int
    {
        return $this->requestId;
    }

    public function getSupportRequestStatusId(): int
    {
        return $this->requestStatusId;
    }
}
