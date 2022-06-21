<?php

namespace App\Http\Presenters\Auth;

use App\Actions\Auth\LoginResponse;
use App\Http\Presenters\PresenterInterface;

final class AuthResponseArrayPresenter implements PresenterInterface
{
    public function present(LoginResponse $response): array
    {
        return [
            'accessToken' => $response->getAccessToken(),
            'tokenType' => $response->getTokenType(),
            'expiresIn' => $response->getExpiresIn(),
        ];
    }
}
