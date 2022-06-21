<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

final class GetSupportRequestByIdRequest
{
    private int $requestId;

    public function __construct(
        int $requestId
    ) {
        $this->requestId = $requestId;
    }

    public function getSupportRequestId(): int
    {
        return $this->requestId;
    }
}
