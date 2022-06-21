<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

final class AddUserWalletRequest
{
    private string $info;
    private int $walletTypeId;

    public function __construct(
        string $info,
        int $walletTypeId
    ) {
        $this->info = $info;
        $this->walletTypeId = $walletTypeId;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getWalletTypeId(): int
    {
        return $this->walletTypeId;
    }
}
