<?php

namespace App\Actions\SocialiteAuth;

use App\Repositories\User\UserRepositoryInterface;
use Laravel\Socialite\Facades\Socialite;

final class SocialiteAddUserAction
{
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }
    public function execute(SocialiteAddUserRequest $request): SocialiteAddUserResponse
    {
        $socialiteUser = Socialite::driver($request->getProviderName())->stateless()->user();

        $column = $request->getProviderName().'_id';

        $userParams = [
            'login' => $socialiteUser->getEmail(),
            'email' => $socialiteUser->getEmail(),
            'password' => bcrypt($socialiteUser->getEmail().'/'.$socialiteUser->getId()),
            'user_photo' => $socialiteUser->getAvatar(),
            $column => $socialiteUser->getId()
        ];

        $this->userRepositoryInterface->updateOrCreateUserByProvider(
            $column,
            (int) $socialiteUser->getId(),
            $userParams
        );

        return new SocialiteAddUserResponse($socialiteUser);
    }
}
