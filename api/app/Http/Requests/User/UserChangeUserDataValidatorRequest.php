<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use App\Http\Requests\ApiFormRequest;

class UserChangeUserDataValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:App\Models\User,id',
            'login' => [
                'required',
                'string',
                Rule::unique('users')->ignore($this->id),
            ],
            'email' => [
                'required',
                'string',
                Rule::unique('users')->ignore($this->id),
            ],
        ];
    }
}
{

}
