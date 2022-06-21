<?php

declare(strict_types=1);

namespace App\Actions\User;

final class ChangeUserDataRequest
{
    private int $id;
    private string $login;
    private string $email;

    public function __construct(
        int $id,
        string $login,
        string $email
    ) {
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
