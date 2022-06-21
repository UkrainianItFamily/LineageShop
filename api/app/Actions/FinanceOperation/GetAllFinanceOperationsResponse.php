<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetAllFinanceOperationsResponse implements Response
{
    private Collection $financeOperations;

    public function __construct(Collection $financeOperations)
    {
        $this->financeOperations = $financeOperations;
    }

    public function getResponse(): Collection
    {
        return $this->financeOperations;
    }
}
