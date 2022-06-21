<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;

class AddUserResponse implements \App\Actions\Response
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getResponse()
    {
        return $this->user;
    }
}
