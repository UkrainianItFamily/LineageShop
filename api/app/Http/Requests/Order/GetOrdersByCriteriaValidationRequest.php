<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiFormRequest;

class GetOrdersByCriteriaValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'orderId' => 'nullable|int',
            'customerLogin' => 'nullable|string',
            'orderStatus' => 'nullable|int',
            'sellerLogin' => 'nullable|string',
        ];
    }
}
