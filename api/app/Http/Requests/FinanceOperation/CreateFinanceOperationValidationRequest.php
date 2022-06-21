<?php

namespace App\Http\Requests\FinanceOperation;

use App\Http\Requests\ApiFormRequest;

class CreateFinanceOperationValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'money' => 'required|int',
            'type' => 'required|int',
            'typeId' => 'required|int',
        ];
    }
}
