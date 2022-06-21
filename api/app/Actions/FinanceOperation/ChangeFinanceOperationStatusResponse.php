<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use App\Actions\Response;
use App\Models\FinanceOperationsHistory;

final class ChangeFinanceOperationStatusResponse implements Response
{
    private FinanceOperationsHistory $financeOperation;

    public function __construct(FinanceOperationsHistory $financeOperation)
    {
        $this->financeOperation = $financeOperation;
    }

    public function getResponse(): FinanceOperationsHistory
    {
        return $this->financeOperation;
    }
}
