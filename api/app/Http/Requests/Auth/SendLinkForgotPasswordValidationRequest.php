<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;

final class SendLinkForgotPasswordValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }
}
