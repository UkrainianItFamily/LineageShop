<?php

declare(strict_types=1);

namespace App\Actions\Order;

final class GetPurchasesForCurrentUserRequest
{
    private ?int $purchaseId;
    private ?string $sellerLogin;
    private ?int $statusId;

    public function __construct(
        ?int $purchaseId,
        ?string $sellerLogin,
        ?int $statusId
    ) {
        $this->purchaseId = $purchaseId;
        $this->sellerLogin = $sellerLogin;
        $this->statusId = $statusId;
    }

    public function getPurchaseId(): ?int
    {
        return $this->purchaseId;
    }

    public function getSellerLogin(): ?string
    {
        return $this->sellerLogin;
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }
}
