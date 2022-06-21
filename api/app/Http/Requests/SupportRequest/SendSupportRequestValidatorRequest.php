<?php

namespace App\Http\Requests\SupportRequest;

use App\Http\Requests\ApiFormRequest;

class SendSupportRequestValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'text' => 'required|string',
            'subject' => 'nullable|int',
            'login' => 'required|string',
            'orderId' => 'nullable|int',
            'email' => 'nullable|email',
        ];
    }
}
