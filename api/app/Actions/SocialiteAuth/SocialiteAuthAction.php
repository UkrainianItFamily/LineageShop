<?php

namespace App\Actions\SocialiteAuth;

use Laravel\Socialite\Facades\Socialite;

final class SocialiteAuthAction
{
    public function execute(SocialiteAuthRequest $request): SocialiteAuthResponse
    {
        $url = Socialite::driver($request->getProviderName())
            ->stateless()
            ->redirect()
            ->getTargetUrl();

        return new SocialiteAuthResponse($url);
    }
}
