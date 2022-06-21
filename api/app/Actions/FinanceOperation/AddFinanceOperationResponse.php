<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use App\Actions\Response;
use App\Models\FinanceOperationsHistory;

class AddFinanceOperationResponse implements Response
{
    private FinanceOperationsHistory $financeOperationsHistory;

    public function __construct(FinanceOperationsHistory $financeOperationsHistory)
    {
        $this->financeOperationsHistory = $financeOperationsHistory;
    }

    public function getResponse(): FinanceOperationsHistory
    {
        return $this->financeOperationsHistory;
    }
}
