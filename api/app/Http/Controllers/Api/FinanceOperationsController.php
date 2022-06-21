<?php

namespace App\Http\Controllers\Api;

use App\Http\Presenters\FinanceOperation\FinanceOperationAsArrayWithoutWalletMaskPresenter;
use App\Http\Requests\FinanceOperation\ChangeFinanceOperationStatusToCancelValidationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\UserWallet\AddUserWalletAction;
use App\Actions\UserWallet\AddUserWalletRequest;
use App\Actions\FinanceOperation\AddFinanceOperationAction;
use App\Actions\FinanceOperation\AddFinanceOperationRequest;
use App\Actions\FinanceOperation\GetAllFinanceOperationsAction;
use App\Actions\FinanceOperation\GetFinanceOperationByIdAction;
use App\Actions\FinanceOperation\GetAllFinanceOperationsRequest;
use App\Actions\FinanceOperation\GetFinanceOperationByIdRequest;
use App\Actions\FinanceOperation\ChangeFinanceOperationStatusAction;
use App\Actions\FinanceOperation\ChangeFinanceOperationStatusRequest;
use App\Actions\FinanceOperation\GetFinanceOperationsForCurrentUserAction;
use App\Http\Presenters\FinanceOperation\FinanceOperationAsArrayPresenter;
use App\Actions\FinanceOperation\GetFinanceOperationsForCurrentUserRequest;
use App\Actions\FinanceOperation\ChangeFinanceOperationStatusToCancelAction;
use App\Actions\FinanceOperation\ChangeFinanceOperationStatusToCancelRequest;
use App\Http\Requests\FinanceOperation\CreateFinanceOperationValidationRequest;

class FinanceOperationsController extends ApiController
{
    public function getAllFinanceOperations(
        GetAllFinanceOperationsAction $getAllFinanceOperationsAction,
        FinanceOperationAsArrayWithoutWalletMaskPresenter $financeOperationAsArrayWithoutWalletMaskPresenter,
        Request $request
    ): JsonResponse {
        $financeOperations = $getAllFinanceOperationsAction
            ->execute(new GetAllFinanceOperationsRequest(
                $request->input('orderType'),
                $request->input('orderDirection'),
                (int) $request->input('id'),
                $request->input('userLogin'),
                (int) $request->input('statusId'),
                $request->input('startDate'),
                $request->input('endDate')
            ))
            ->getResponse();

        $presenter = $financeOperationAsArrayWithoutWalletMaskPresenter->presentCollection($financeOperations);

        return $this->successResponse($presenter);
    }
    public function getFinanceOperationsForCurrentUser(
        GetFinanceOperationsForCurrentUserAction $getFinanceOperationForUserAction,
        FinanceOperationAsArrayPresenter $financeOperationAsArrayPresenter,
        Request $request
    ): JsonResponse {
        $financeOperations = $getFinanceOperationForUserAction
            ->execute(new GetFinanceOperationsForCurrentUserRequest((int) $request->input('type')))
            ->getResponse();

        $presenter = $financeOperationAsArrayPresenter->presentCollection($financeOperations);

        return $this->successResponse($presenter);
    }

    public function getFinanceOperationById(
        GetFinanceOperationByIdAction $getFinanceOperationByIdAction,
        FinanceOperationAsArrayPresenter $financeOperationAsArrayPresenter,
        string $financeOperationId
    ): JsonResponse {
        $financeOperation = $getFinanceOperationByIdAction
            ->execute(new GetFinanceOperationByIdRequest((int) $financeOperationId))
            ->getResponse();

        $presenter = $financeOperationAsArrayPresenter->present($financeOperation);

        return $this->successResponse($presenter);
    }

    public function create(
        AddUserWalletAction $addUserWalletAction,
        AddFinanceOperationAction $addFinanceOperationAction,
        FinanceOperationAsArrayPresenter $financeOperationAsArrayPresenter,
        CreateFinanceOperationValidationRequest $request
    ): JsonResponse {
        if (!$request->input('walletId')) {
            $userWallet = $addUserWalletAction
                ->execute(
                    new AddUserWalletRequest(
                        $request->input('info'),
                        $request->input('typeId')
                    )
                )
                ->getResponse();
        }
        $newFinanceOperation = $addFinanceOperationAction
            ->execute(new AddFinanceOperationRequest(
                $request->input('money'),
                ($request->input('walletId'))
                    ? $request->input('walletId')
                    : $userWallet->getId(),
                $request->input('type'),
                $request->input('userId'),
                $request->input('statusId'),
            ))->getResponse();

        $presenter = $financeOperationAsArrayPresenter->present($newFinanceOperation);

        return $this->successResponse($presenter);
    }

    public function changeFinanceOperationStatusToCancel(
        ChangeFinanceOperationStatusToCancelAction $changeFinanceOperationStatusAction,
        FinanceOperationAsArrayPresenter $financeOperationAsArrayPresenter,
        ChangeFinanceOperationStatusToCancelValidationRequest $request
    ): JsonResponse {
        $financeOperation = $changeFinanceOperationStatusAction
            ->execute(new ChangeFinanceOperationStatusToCancelRequest(
                (int) $request->financeOperationId,
                $request->cancelInfo
            ))
            ->getResponse();

        $presenter = $financeOperationAsArrayPresenter->present($financeOperation);

        return $this->successResponse($presenter);
    }

    public function changeFinanceOperationStatus(
        ChangeFinanceOperationStatusAction $changeFinanceOperationStatusAction,
        FinanceOperationAsArrayPresenter $financeOperationAsArrayPresenter,
        Request $request
    ): JsonResponse {
        $financeOperation = $changeFinanceOperationStatusAction
            ->execute(new ChangeFinanceOperationStatusRequest(
                (int) $request->input('id'),
                (int) $request->input('status'),
            ))
            ->getResponse();

        $presenter = $financeOperationAsArrayPresenter->present($financeOperation);

        return $this->successResponse($presenter);
    }
}
