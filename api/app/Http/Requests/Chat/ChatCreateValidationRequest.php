<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\ApiFormRequest;

class ChatCreateValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'recipientUserId' => 'required|integer|exists:App\Models\User,id',
        ];
    }
}
