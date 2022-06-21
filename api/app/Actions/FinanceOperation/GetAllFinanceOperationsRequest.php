<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

final class GetAllFinanceOperationsRequest
{
    private ?string $orderType;
    private ?string $orderDirection;
    private ?int $id;
    private ?string $userLogin;
    private ?int $statusId;
    private ?string $startDate;
    private ?string $endDate;

    public function __construct(
        ?string $orderType,
        ?string $orderDirection,
        ?int $id,
        ?string $userLogin,
        ?int $statusId,
        ?string $startDate,
        ?string $endDate
    ) {
        $this->orderType = $orderType;
        $this->orderDirection = $orderDirection;
        $this->id = $id;
        $this->userLogin = $userLogin;
        $this->statusId = $statusId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    public function getOrderDirection(): ?string
    {
        return $this->orderDirection;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserLogin(): ?string
    {
        return $this->userLogin;
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }
}
