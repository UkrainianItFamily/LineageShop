<?php

declare(strict_types=1);

namespace App\Actions\User;

use Auth;
use App\Repositories\User\UserRepositoryInterface;
use App\Exceptions\User\UserNotAuthorizedException;

final class GetAllUsersAction
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(): GetAllUsersResponse
    {
        if (!Auth::id()) {
            throw new UserNotAuthorizedException();
        }

        $users = $this->userRepositoryInterface->getAll();

        return new GetAllUsersResponse($users);
    }
}
