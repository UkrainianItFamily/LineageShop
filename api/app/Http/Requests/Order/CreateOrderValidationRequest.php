<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiFormRequest;

class CreateOrderValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'productId' => 'required|int|exists:App\Models\Product,id',
            'userSellerId' => 'required|int|exists:App\Models\User,id',
            'walletTypeId' => 'required|int|exists:App\Models\WalletType,id',
        ];
    }
}
