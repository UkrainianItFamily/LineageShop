<?php

namespace App\Actions\SocialiteAuth;

use Laravel\Socialite\Two\User;

final class SocialiteAddUserResponse
{
    private User $socialiteUser;

    public function __construct(User $socialiteUser)
    {
        $this->socialiteUser = $socialiteUser;
    }

    public function getResponse(): User
    {
        return $this->socialiteUser;
    }
}
