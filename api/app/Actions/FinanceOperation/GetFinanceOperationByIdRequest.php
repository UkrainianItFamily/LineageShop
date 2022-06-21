<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

final class GetFinanceOperationByIdRequest
{
    private int $financeOperationId;

    public function __construct(int $financeOperationId)
    {
        $this->financeOperationId = $financeOperationId;
    }

    public function getId(): int
    {
        return $this->financeOperationId;
    }
}
