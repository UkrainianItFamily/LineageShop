<?php

namespace App\Http\Requests\SupportRequestMessage;

use App\Http\Requests\ApiFormRequest;

class SendSupportRequestMessageValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'text' => 'required|string',
            'supportRequestId' => 'required|integer',
            'supportRequestAuthorId' => 'required|integer',
            'supportRequestSubjectId' => 'required|integer'
        ];
    }
}
