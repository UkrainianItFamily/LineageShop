<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiFormRequest;

class UserLoginValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:1|confirmed',
        ];
    }
}
