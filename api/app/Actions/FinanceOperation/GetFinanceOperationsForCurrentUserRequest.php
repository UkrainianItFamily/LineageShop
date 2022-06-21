<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

final class GetFinanceOperationsForCurrentUserRequest
{
    private ?int $financeOperationTypeId;

    public function __construct(?int $financeOperationTypeId)
    {
        $this->financeOperationTypeId = $financeOperationTypeId;
    }

    public function getFinanceOperationTypeId(): ?int
    {
        return $this->financeOperationTypeId;
    }
}
