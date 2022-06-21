<?php

declare(strict_types=1);

namespace App\Actions\User;

use Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepositoryInterface;
use App\Exceptions\User\PassedUserPasswordNotMatchCurrentException;

final class ChangePasswordAction
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(ChangePasswordRequest $request): void
    {
        $user = $this->userRepositoryInterface->getById(Auth::id());

        if (!Hash::check($request->getCurrentPassword(), $user->getAuthPassword())) {
            throw new PassedUserPasswordNotMatchCurrentException();
        }

        $user->password = Hash::make($request->getNewPassword());

        $this->userRepositoryInterface->update($user);
    }
}
