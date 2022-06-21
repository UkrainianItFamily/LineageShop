<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Actions\WalletType\GetWalletTypesAction;
use App\Http\Presenters\WalletType\WalletTypeAsArrayPresenter;

class WalletTypeController extends ApiController
{
    public function getWalletTypes(
        GetWalletTypesAction $getWalletTypesAction,
        WalletTypeAsArrayPresenter $walletTypeAsArrayPresenter
    ): JsonResponse {
        $walletTypes = $getWalletTypesAction
            ->execute()
            ->getResponse();

        $presenter = $walletTypeAsArrayPresenter->presentCollection($walletTypes);

        return $this->successResponse($presenter);
    }
}
