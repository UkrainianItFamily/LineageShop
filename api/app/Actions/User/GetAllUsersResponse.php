<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Actions\Response;
use Illuminate\Support\Collection;

class GetAllUsersResponse implements Response
{
    private Collection $users;

    public function __construct(Collection $users)
    {
        $this->users = $users;
    }

    public function getResponse(): Collection
    {
        return $this->users;
    }
}
