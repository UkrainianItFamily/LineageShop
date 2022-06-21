<?php

namespace App\Actions\SocialiteAuth;

final class SocialiteAuthResponse
{
    private string $targetUrl;

    public function __construct(
        string $targetUrl
    ) {
        $this->targetUrl = $targetUrl;
    }

    public function getResponse(): string
    {
        return $this->targetUrl;
    }
}
