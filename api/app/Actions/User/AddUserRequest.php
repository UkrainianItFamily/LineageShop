<?php

declare(strict_types=1);

namespace App\Actions\User;

class AddUserRequest
{
    private string $login;

    private string $email;

    private string $password;

    private bool $license;

    public function __construct(
        string $login,
        string $email,
        string $password,
        bool $license
    ) {
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->license = $license;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getLicense(): bool
    {
        return $this->license;
    }
}
