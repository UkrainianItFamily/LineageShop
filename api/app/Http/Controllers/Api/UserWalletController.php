<?php

namespace App\Http\Controllers\Api;

use App\Actions\UserWallet\AddUserWalletAction;
use App\Actions\UserWallet\AddUserWalletRequest;
use App\Http\Requests\UserWallet\AddUserWalletValidationRequest;
use Illuminate\Http\JsonResponse;
use App\Actions\UserWallet\DeleteUserWalletAction;
use App\Actions\UserWallet\UpdateUserWalletAction;
use App\Actions\UserWallet\UpdateUserWalletRequest;
use App\Actions\UserWallet\DeleteUserWalletRequest;
use App\Actions\UserWallet\GetUserWalletsForCurrentUserAction;
use App\Http\Presenters\UserWallet\UserWalletAsArrayPresenter;
use App\Actions\UserWallet\GetUserWalletsByWalletTypeIdAction;
use App\Actions\UserWallet\GetUserWalletsByWalletTypeIdRequest;
use App\Http\Requests\UserWallet\UpdateUserWalletValidationRequest;

class UserWalletController extends ApiController
{
    public function getUserWalletsByWalletTypeId(
        GetUserWalletsByWalletTypeIdAction $getUserWalletsByWalletTypeIdAction,
        UserWalletAsArrayPresenter $userWalletAsArrayPresenter,
        string $walletTypeId
    ): JsonResponse {
        $userWallets = $getUserWalletsByWalletTypeIdAction
            ->execute(new GetUserWalletsByWalletTypeIdRequest((int) $walletTypeId))
            ->getResponse();
        $presenter = $userWalletAsArrayPresenter->presentCollection($userWallets);

        return $this->successResponse($presenter);
    }

    public function getUserWalletsForCurrentUser(
        GetUserWalletsForCurrentUserAction $getUserWalletsForCurrentUserAction,
        UserWalletAsArrayPresenter $userWalletAsArrayPresenter
    ): JsonResponse {
        $userWallets = $getUserWalletsForCurrentUserAction
            ->execute()
            ->getResponse();
        $presenter = $userWalletAsArrayPresenter->presentCollection($userWallets);

        return $this->successResponse($presenter);
    }

    public function save(
        AddUserWalletAction $addUserWalletAction,
        UserWalletAsArrayPresenter $userWalletAsArrayPresenter,
        AddUserWalletValidationRequest $request
    ): JsonResponse {
        $updatedUserWallet = $addUserWalletAction
            ->execute(new AddUserWalletRequest(
                $request->input('info'),
                $request->input('walletTypeId'),
            ))
            ->getResponse();
        $presenter = $userWalletAsArrayPresenter->present($updatedUserWallet);

        return $this->successResponse($presenter);
    }

    public function update(
        UpdateUserWalletAction $updateUserWalletAction,
        UserWalletAsArrayPresenter $userWalletAsArrayPresenter,
        UpdateUserWalletValidationRequest $request
    ): JsonResponse {
        $updatedUserWallet = $updateUserWalletAction
            ->execute(new UpdateUserWalletRequest(
                $request->input('id'),
                $request->input('info'),
                $request->input('walletTypeId'),
            ))
            ->getResponse();
        $presenter = $userWalletAsArrayPresenter->present($updatedUserWallet);

        return $this->successResponse($presenter);
    }

    public function delete(
        DeleteUserWalletAction $deleteUserWalletAction,
        string $userWalletId
    ): JsonResponse {
        $deleteUserWalletAction
            ->execute(new DeleteUserWalletRequest((int) $userWalletId));

        return $this->successResponse(['msg' => 'OK']);
    }
}
