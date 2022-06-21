<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use App\Actions\Response;

class ChangeUserDataResponse implements Response
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getResponse(): User
    {
        return $this->user;
    }
}
