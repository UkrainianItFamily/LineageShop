<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Actions\Status\StatusAction;
use App\Http\Presenters\Status\StatusArrayPresenter;

class StatusController extends ApiController
{
    public function status(
        Request $request,
        StatusAction $action,
        StatusArrayPresenter $presenter
    ) {
        $serviceName = $request->route('serviceName');
        $response = $action->execute($serviceName);

        return $this->successResponse(
            $presenter->presentCollection($response->getStatusParameters())
        );
    }
}
