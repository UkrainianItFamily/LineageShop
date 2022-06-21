<?php

namespace App\Actions\SocialiteAuth;

final class SocialiteAddUserRequest
{
    private string $providerName;

    public function __construct(
        string $providerName
    ) {
        $this->providerName = $providerName;
    }

    public function getProviderName(): string
    {
        return $this->providerName;
    }
}
