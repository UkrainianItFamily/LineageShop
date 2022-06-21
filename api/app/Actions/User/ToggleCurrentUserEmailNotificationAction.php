<?php

declare(strict_types=1);

namespace App\Actions\User;

use Auth;
use App\Constant\UserConstant;
use App\Repositories\User\UserRepositoryInterface;

final class ToggleCurrentUserEmailNotificationAction
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(): ToggleCurrentUserEmailNotificationResponse
    {
        $user = $this->userRepositoryInterface->getById(Auth::id());

        if ($user->getConfirmSendEmail() === UserConstant::CONFIRM_SEND_EMAIL_OFF) {
            $user->confirm_send_email = UserConstant::CONFIRM_SEND_EMAIL_ON;
        } else {
            $user->confirm_send_email = UserConstant::CONFIRM_SEND_EMAIL_OFF;
        }

        $this->userRepositoryInterface->update($user);

        return new ToggleCurrentUserEmailNotificationResponse($user);
    }
}
