<?php

namespace App\Http\Requests\FinanceOperation;

use App\Http\Requests\ApiFormRequest;

class ChangeFinanceOperationStatusToCancelValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'financeOperationId' => 'required|int|exists:finance_operations_histories,id',
            'cancelInfo' => 'required|string',
        ];
    }
}
