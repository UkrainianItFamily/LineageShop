<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiFormRequest;

class ConfirmOrderValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'orderId' => 'required|int|exists:App\Models\Order,id',
        ];
    }
}
