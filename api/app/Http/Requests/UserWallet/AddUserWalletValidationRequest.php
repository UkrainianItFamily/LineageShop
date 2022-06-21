<?php

namespace App\Http\Requests\UserWallet;

use App\Http\Requests\ApiFormRequest;

class AddUserWalletValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'info' => 'required|string',
            'walletTypeId' => 'required|int|exists:App\Models\WalletType,id',
        ];
    }
}
