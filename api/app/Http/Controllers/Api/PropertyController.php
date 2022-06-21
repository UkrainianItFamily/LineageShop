<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\Property\GetPropertyByCategoryIdAction;
use App\Actions\Property\GetPropertyByCategoryIdRequest;
use App\Http\Presenters\Property\PropertyAsArrayPresenter;

class PropertyController extends ApiController
{
    public function getPropertyByCategoryId(
        GetPropertyByCategoryIdAction $getPropertyByCategoryIdAction,
        PropertyAsArrayPresenter $propertyAsArrayPresenter,
        Request $request
    ): JsonResponse {
        $propertyList = $getPropertyByCategoryIdAction
            ->execute(new GetPropertyByCategoryIdRequest(
                  (int) $request->input('categoryId')
            ))
            ->getResponse();
        $presenter = $propertyAsArrayPresenter->presentCollection($propertyList);

        return $this->successResponse($presenter);
    }
}
