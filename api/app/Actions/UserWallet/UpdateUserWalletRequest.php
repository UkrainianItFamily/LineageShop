<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

final class UpdateUserWalletRequest
{
    private int $id;
    private string $info;
    private int $walletTypeId;

    public function __construct(
        int $id,
        string $info,
        int $walletTypeId
    ) {
        $this->id = $id;
        $this->info = $info;
        $this->walletTypeId = $walletTypeId;
    }

    public function getId(): int
    {
        return $this->id;
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
