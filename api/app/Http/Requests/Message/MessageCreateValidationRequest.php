<?php

namespace App\Http\Requests\Message;

use App\Http\Requests\ApiFormRequest;

class MessageCreateValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'message' => 'required|min:1',
            'chatId' => 'required|integer|exists:App\Models\Chat,id',
        ];
    }
}
