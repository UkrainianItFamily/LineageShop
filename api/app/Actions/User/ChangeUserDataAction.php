<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Repositories\User\UserRepositoryInterface;

final class ChangeUserDataAction
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(ChangeUserDataRequest $request): ChangeUserDataResponse
    {
        $user = $this->userRepositoryInterface->getById($request->getId());

        $user->login = $request->getLogin();
        $user->email = $request->getEmail();

        $updatedUser = $this->userRepositoryInterface->update($user);

        return new ChangeUserDataResponse($updatedUser);
    }
}
