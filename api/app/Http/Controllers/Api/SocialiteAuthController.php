<?php

namespace App\Http\Controllers\Api;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginRequest;
use App\Actions\SocialiteAuth\SocialiteAddUserAction;
use App\Actions\SocialiteAuth\SocialiteAddUserRequest;
use App\Actions\SocialiteAuth\SocialiteAuthAction;
use App\Actions\SocialiteAuth\SocialiteAuthRequest;
use App\Http\Presenters\Auth\AuthResponseArrayPresenter;
class SocialiteAuthController extends ApiController
{
    public function authUserFromSocialite(SocialiteAuthAction $socialiteAuthAction, $providerName)
    {
        $url = $socialiteAuthAction->execute(
            new SocialiteAuthRequest(
                $providerName
            ))->getResponse();

        return response()->json([
            "url" => $url
        ]);
    }

    public function addUserFromSocialite(
        LoginAction $loginAction,
        SocialiteAddUserAction $socialiteLoginAction,
        AuthResponseArrayPresenter $authResponseArrayPresenter,
        $providerName
    ) {
            $socialiteUser = $socialiteLoginAction->execute(
                new SocialiteAddUserRequest(
                    $providerName
                ))->getResponse();

            $response = $loginAction->execute(
                new LoginRequest(
                    $socialiteUser->getEmail(),
                    $socialiteUser->getEmail().'/'.$socialiteUser->getId(),
                )
            );

            return $this->successResponse($authResponseArrayPresenter->present($response));
    }
}
