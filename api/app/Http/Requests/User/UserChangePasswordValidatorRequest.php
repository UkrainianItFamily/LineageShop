<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiFormRequest;

class UserChangePasswordValidatorRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'currentPassword' => 'required|string|min:8',
            'newPassword' => 'required|string|min:8',
            'confirmNewPassword' => 'required|same:newPassword',
        ];
    }
}
