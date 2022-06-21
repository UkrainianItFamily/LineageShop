<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

final class ResetPasswordValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:50',
            'password' => 'required|min:8|string|confirmed',
            'token' => 'required',
        ];
    }
}
