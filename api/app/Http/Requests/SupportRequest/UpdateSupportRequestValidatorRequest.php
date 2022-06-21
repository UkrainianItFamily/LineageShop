<?php

namespace App\Http\Requests\SupportRequest;

use App\Http\Requests\ApiFormRequest;

class UpdateSupportRequestValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'requestId' => 'required|integer|exists:support_requests,id',
            'requestStatusId' => 'required|integer'
        ];
    }
}
