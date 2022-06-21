<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

class BindEmailValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
          'email' => 'required|email|unique:users',
        ];
    }
}
