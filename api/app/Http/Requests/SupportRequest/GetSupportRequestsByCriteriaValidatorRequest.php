<?php

namespace App\Http\Requests\SupportRequest;

use App\Http\Requests\ApiFormRequest;

class GetSupportRequestsByCriteriaValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'nullable|integer|exists:support_requests,id',
            'statusId' => 'nullable|integer',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'userId' => 'nullable|integer|exists:users,id'
        ];
    }
}
