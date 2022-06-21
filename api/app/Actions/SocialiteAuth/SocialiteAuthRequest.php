<?php

namespace App\Actions\SocialiteAuth;

final class SocialiteAuthRequest
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
