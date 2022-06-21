<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

final class AddEnrollmentFinanceOperationRequest
{
    private int $money;
    private int $sellerId;

    public function __construct(
        int $money,
        int $sellerId
    ) {
        $this->money = $money;
        $this->sellerId = $sellerId;
    }

    public function getMoney(): int
    {
        return $this->money;
    }

    public function getSellerId(): int
    {
        return $this->sellerId;
    }
}
