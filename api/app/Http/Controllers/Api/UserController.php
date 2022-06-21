<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\User\BindEmailAction;
use App\Actions\User\BindEmailRequest;
use App\Actions\User\GetAllUsersAction;
use App\Actions\User\GetUserByIdAction;
use App\Actions\User\GetUserByIdRequest;
use App\Actions\User\ChangePasswordAction;
use App\Actions\User\ChangeUserDataAction;
use App\Actions\User\ChangePasswordRequest;
use App\Actions\User\ChangeUserDataRequest;
use App\Actions\User\UpdateEmailByUserIdAction;
use App\Actions\User\UpdateEmailByUserIdRequest;
use App\Http\Presenters\User\UserArrayPresenter;
use App\Actions\User\AdminResetUserPasswordAction;
use App\Actions\User\AdminResetUserPasswordRequest;
use App\Http\Requests\Auth\BindEmailValidationRequest;
use App\Actions\User\ToggleCurrentUserEmailNotificationAction;
use App\Http\Requests\User\UserChangePasswordValidatorRequest;
use App\Http\Requests\User\UserChangeUserDataValidatorRequest;
use App\Http\Requests\User\AdminResetUserPasswordValidatorRequest;

class UserController extends ApiController
{
    public function getAllUsers(
        GetAllUsersAction $getAllUsersAction,
        UserArrayPresenter $userArrayPresenter
    ): JsonResponse {
        $users = $getAllUsersAction
            ->execute()
            ->getResponse();
        $presenter = $userArrayPresenter->presentCollection($users);

        return $this->successResponse($presenter);
    }
    public function getUserById(
        GetUserByIdAction $getUserByIdAction,
        UserArrayPresenter $userArrayPresenter,
        string $userId
    ): JsonResponse {
        $user = $getUserByIdAction
            ->execute(new GetUserByIdRequest((int) $userId))
            ->getResponse();
        $presenter = $userArrayPresenter->present($user);

        return $this->successResponse($presenter);
    }

    public function adminResetUserPassword(
        AdminResetUserPasswordAction $adminResetUserPasswordAction,
        AdminResetUserPasswordValidatorRequest $request
    ): JsonResponse {
        $adminResetUserPasswordAction->
            execute(
                new AdminResetUserPasswordRequest(
                $request->input('id'),
            )
            );

        return $this->successResponse(['msg' => 'OK']);
    }

    public function changePassword(
        ChangePasswordAction $changePasswordAction,
        UserChangePasswordValidatorRequest $request
    ): JsonResponse {
        $changePasswordAction
            ->execute(new ChangePasswordRequest(
                $request->input('currentPassword'),
                $request->input('newPassword')
            ));

        return $this->successResponse(['msg' => 'OK']);
    }

    public function changeUserData(
        ChangeUserDataAction $changeUserDataAction,
        UserArrayPresenter $userArrayPresenter,
        UserChangeUserDataValidatorRequest $request
    ): JsonResponse {
        $updatedUser = $changeUserDataAction
            ->execute(
                new ChangeUserDataRequest(
                $request->input('id'),
                $request->input('login'),
                $request->input('email')
            )
            )
            ->getResponse();
        $presenter = $userArrayPresenter->present($updatedUser);

        return $this->successResponse($presenter);
    }

    public function toggleCurrentUserEmailNotification(
        ToggleCurrentUserEmailNotificationAction $toggleCurrentUserEmailNotificationAction,
        UserArrayPresenter $userArrayPresenter
    ): JsonResponse {
        $user = $toggleCurrentUserEmailNotificationAction
            ->execute()
            ->getResponse();
        $presenter = $userArrayPresenter->present($user);

        return $this->successResponse($presenter);
    }

    public function bindEmail(
        BindEmailAction $bindEmailAction,
        BindEmailValidationRequest $request
    ): JsonResponse {
        $bindEmailAction
            ->execute(new BindEmailRequest(
                $request->input('email')
            ));

        return $this->successResponse(['msg' => 'OK']);
    }

    public function updateEmailByUserId(
        UpdateEmailByUserIdAction $updateEmailByUserIdAction,
        UserArrayPresenter $userArrayPresenter,
        Request $request
    ): JsonResponse {
        $updatedUser = $updateEmailByUserIdAction
            ->execute(new UpdateEmailByUserIdRequest(
                $request->input('token')
            ))
            ->getResponse();

        $presenter = $userArrayPresenter->present($updatedUser);

        return $this->successResponse($presenter);
    }
}
