<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

final class AddFinanceOperationRequest
{
    private int $money;
    private int $walletId;
    private int $type;
    private ?int $userId;
    private ?int $statusId;

    public function __construct(
        int $money,
        int $walletId,
        int $type,
        ?int $userId,
        ?int $statusId
    ) {
        $this->money = $money;
        $this->walletId = $walletId;
        $this->type = $type;
        $this->userId = $userId;
        $this->statusId = $statusId;
    }

    public function getMoney(): int
    {
        return $this->money;
    }

    public function getWalletId(): int
    {
        return $this->walletId;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getStatusId(): ?int
    {
        return $this->statusId;
    }
}
