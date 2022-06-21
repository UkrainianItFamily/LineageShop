<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

final class AddWriteOffsFinanceOperationRequest
{
    private int $money;

    public function __construct(
        int $money
    ) {
        $this->money = $money;
    }

    public function getMoney(): int
    {
        return $this->money;
    }
}
