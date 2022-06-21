<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiFormRequest;

class UserCreateValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'login' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'license' => 'bool',
        ];
    }
}
