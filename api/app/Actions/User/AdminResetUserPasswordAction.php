<?php

declare(strict_types=1);

namespace App\Actions\User;

use Str;
use App\Repositories\User\UserRepositoryInterface;

final class AdminResetUserPasswordAction
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(AdminResetUserPasswordRequest $request): void
    {
        $user = $this->userRepositoryInterface->getById($request->getUserId());

        $user->password_reset_admin = true;
        $this->userRepositoryInterface->save($user);

        $password = Str::random(10);

        $user->sendAdminResetPasswordNotification($user->getEmail(), $password);
    }
}
