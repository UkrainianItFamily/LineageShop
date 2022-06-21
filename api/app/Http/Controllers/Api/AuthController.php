<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\ResetPasswordAction;
use App\Actions\Auth\ResetPasswordRequest;
use App\Actions\Auth\SendLinkForgotPasswordAction;
use App\Actions\Auth\SendLinkForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordValidationRequest;
use App\Http\Requests\Auth\SendLinkForgotPasswordValidationRequest;
use Illuminate\Http\Request;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginRequest;
use App\Actions\Auth\LogoutAction;
use App\Actions\User\AddUserAction;
use App\Actions\User\AddUserRequest;
use App\Actions\Auth\EmailVerificationAction;
use App\Actions\Auth\EmailVerificationRequest;
use App\Actions\Auth\GetAuthenticatedUserAction;
use App\Http\Presenters\User\UserArrayPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\User\UserCreateValidatorRequest;
use App\Http\Presenters\Auth\AuthResponseArrayPresenter;

class AuthController extends ApiController
{
    public function register(
        AddUserAction $addUserAction,
        UserCreateValidatorRequest $request
    ): JsonResponse {
        $addUserAction
            ->execute(new AddUserRequest(
                $request->login,
                $request->email,
                $request->password,
                $request->license,
            ));

        return $this->successResponse(['msg' => 'OK']);
    }

    public function emailVerification(Request $request, EmailVerificationAction $emailVerificationAction): JsonResponse
    {
        $emailVerificationAction->execute(
            new EmailVerificationRequest(
                $request->id,
                $request->hash
            )
        );

        return $this->successResponse(['msg' => 'OK']);
    }

    public function login(
        Request $request,
        LoginAction $loginAction,
        AuthResponseArrayPresenter $authResponseArrayPresenter
    ): JsonResponse {
        $response = $loginAction->execute(
            new LoginRequest(
                $request->email,
                $request->password,
            )
        );

        return $this->successResponse($authResponseArrayPresenter->present($response));
    }

    public function me(
        GetAuthenticatedUserAction $getAuthenticatedUserAction,
        UserArrayPresenter $userArrayPresenter
    ): JsonResponse {
        $response = $getAuthenticatedUserAction->execute();

        return $this->successResponse($userArrayPresenter->present($response->getUser()));
    }

    public function logout(
        LogoutAction $logoutAction
    ): JsonResponse {
        $logoutAction->execute();

        return $this->successResponse(['msg' => 'Logged out Successfully.']);
    }

    public function sendLinkForgotPassword(
        SendLinkForgotPasswordValidationRequest $request,
        SendLinkForgotPasswordAction $sendLinkForgotPasswordAction
    ): JsonResponse {
        $sendLinkForgotPasswordAction->execute(
            new SendLinkForgotPasswordRequest($request->email)
        );

        return $this->emptyResponse();
    }

    public function resetPassword(
        ResetPasswordValidationRequest $request,
        ResetPasswordAction $resetPasswordAction
    ): JsonResponse {
        $resetPasswordAction->execute(
            new ResetPasswordRequest(
                $request->get('email'),
                $request->get('password'),
                $request->get('token'),
            )
        );

        return $this->emptyResponse();
    }
}
