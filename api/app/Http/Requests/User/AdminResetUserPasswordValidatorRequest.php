<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiFormRequest;

class AdminResetUserPasswordValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:App\Models\User,id',
        ];
    }
}
{

}
