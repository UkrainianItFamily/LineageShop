<?php

namespace App\Http\Requests\UserWallet;

use App\Http\Requests\ApiFormRequest;

class UpdateUserWalletValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:App\Models\UserWallet,id',
            'info' => 'required|string',
            'walletTypeId' => 'required|int|exists:App\Models\WalletType,id',
        ];
    }
}
