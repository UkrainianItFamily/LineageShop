<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiFormRequest;

class ChangeOrderStatusValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:App\Models\Order,id',
        ];
    }
}
