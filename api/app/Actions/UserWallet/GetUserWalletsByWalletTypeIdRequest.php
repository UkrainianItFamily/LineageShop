<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

final class GetUserWalletsByWalletTypeIdRequest
{
    private ?int $walletTypeId;

    public function __construct(?int $walletTypeId)
    {
        $this->walletTypeId = $walletTypeId;
    }

    public function getWalletTypeId(): ?int
    {
        return $this->walletTypeId;
    }
}
