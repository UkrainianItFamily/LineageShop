<?php

declare(strict_types=1);

namespace App\Actions\Order;

final class GetSalesForCurrentUserRequest
{
    private ?int $saleId;
    private ?string $customerLogin;
    private ?int $statusId;

    public function __construct(
        ?int $saleId,
        ?string $customerLogin,
        ?int $statusId )
    {
        $this->saleId = $saleId;
        $this->customerLogin = $customerLogin;
        $this->statusId = $statusId;
    }

    public function getSaleId(): ?int
    {
        return $this->saleId;
    }

    public function getCustomerLogin(): ?string
    {
        return $this->customerLogin;
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }
}
