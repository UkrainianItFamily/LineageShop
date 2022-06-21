<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

final class GetSupportRequestCriteriaRequest
{
    private ?int $requestId;
    private ?string $startDate;
    private ?string $endDate;
    private ?int $statusId;
    private ?int $userId;

    public function __construct(
        ?int $requestId,
        ?string $startDate,
        ?string $endDate,
        ?int $statusId,
        ?int $userId
    ) {
        $this->requestId = $requestId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->statusId = $statusId;
        $this->userId = $userId;
    }

    public function getSupportRequestId(): ?int
    {
        return $this->requestId;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }

     public function getUserId(): ?int
    {
        return $this->userId;
    }
}
