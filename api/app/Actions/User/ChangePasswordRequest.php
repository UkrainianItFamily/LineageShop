<?php

declare(strict_types=1);

namespace App\Actions\User;

final class ChangePasswordRequest
{
    private string $currentPassword;
    private string $newPassword;

    public function __construct(
        string $currentPassword,
        string $newPassword
    ) {
        $this->currentPassword = $currentPassword;
        $this->newPassword = $newPassword;
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }
}
