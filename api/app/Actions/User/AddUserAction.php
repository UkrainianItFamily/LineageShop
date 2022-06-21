<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Mail\Mailer;
use App\Repositories\User\UserRepositoryInterface;

final class AddUserAction
{
    private UserRepositoryInterface $userRepositoryInterface;

    private Mailer $mailer;

    public function __construct(UserRepositoryInterface $userRepositoryInterface, Mailer $mailer)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->mailer = $mailer;
    }

    public function execute(AddUserRequest $request): void
    {
        $newUser = new User();
        $newUser->login = $request->getLogin();
        $newUser->email = $request->getEmail();
        $newUser->password = bcrypt($request->getPassword());
        $newUser->license = $request->getLicense();

        $this->userRepositoryInterface->save($newUser);

        $newUser->sendEmailVerificationNotification();
    }
}
