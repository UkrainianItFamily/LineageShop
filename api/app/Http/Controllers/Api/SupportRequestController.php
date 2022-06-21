<?php

namespace App\Http\Controllers\Api;

use App\Actions\SupportRequest\GetSupportRequestByCriteriaAction;
use App\Actions\SupportRequest\GetSupportRequestByCriteriaForUserAction;
use App\Actions\SupportRequest\GetSupportRequestByCriteriaForUserRequest;
use App\Actions\SupportRequest\GetSupportRequestByIdAction;
use App\Actions\SupportRequest\GetSupportRequestCriteriaRequest;
use App\Actions\SupportRequest\GetSupportsAction;
use App\Actions\SupportRequest\SendSupportRequest;
use App\Actions\SupportRequest\UpdateSupportStatusAction;
use App\Actions\SupportRequest\UpdateSupportStatusRequest;
use App\Actions\SupportRequestMessage\GetAllSupportMessagesAction;
use App\Actions\SupportRequestMessage\GetSupportRequestMessages;
use App\Actions\SupportRequestMessage\SendSupportRequestMessageAction;
use App\Actions\SupportRequestMessage\SendSupportRequestMessageRequest;
use App\Http\Presenters\SupportRequest\SupportRequestAsArrayPresenter;
use App\Http\Presenters\SupportRequestMessage\SupportRequestMessagesAsArrayPresenter;
use App\Http\Requests\SupportRequest\GetSupportRequestsByCriteriaValidatorRequest;
use App\Http\Requests\SupportRequest\UpdateSupportRequestValidatorRequest;
use App\Http\Requests\SupportRequestMessage\SendSupportRequestMessageValidatorRequest;
use Illuminate\Http\JsonResponse;
use App\Actions\SupportRequest\GetSupportRequestByIdRequest;
use App\Actions\SupportRequest\SendSupportRequestAction;
use App\Http\Requests\SupportRequest\SendSupportRequestValidatorRequest;

class SupportRequestController extends ApiController
{
    public function sendSupportRequest(
        SendSupportRequestAction $sendSupportRequestAction,
        SendSupportRequestMessageAction $sendSupportRequestMessageAction,
        SendSupportRequestValidatorRequest $request
    ): JsonResponse {
        $sendSupportRequestResponse = $sendSupportRequestAction
            ->execute(new SendSupportRequest(
                $request->input('text'),
                $request->input('subject'),
                $request->input('orderId'),
                $request->input('login'),
                $request->input('email')
            ))
            ->getResponse();

        $sendSupportRequestMessageAction->execute(new SendSupportRequestMessageRequest(
            $request->input('text'),
            $sendSupportRequestResponse->id
        ));

        return $this->successResponse(['msg' => 'OK']);
    }

    public function getSupportRequests(
        GetSupportsAction $supportsAction,
        SupportRequestAsArrayPresenter $supportRequestAsArrayPresenter
    ): JsonResponse {
        $SupportRequestsResponse= $supportsAction
            ->execute()->getResponse();

        $presenter = $supportRequestAsArrayPresenter->presentCollection($SupportRequestsResponse);

        return $this->successResponse($presenter);
    }

    public function getAllSupportRequestMessages(
        GetAllSupportMessagesAction $supportMessagesAction,
        SupportRequestMessagesAsArrayPresenter $supportRequestMessagesAsArrayPresenter,
        ?string $id
    ): JsonResponse {
        $supportRequestMessagesResponse = $supportMessagesAction
            ->execute(new GetSupportRequestMessages(
                (int) $id
            ))
            ->getResponse();

        $presenter = $supportRequestMessagesAsArrayPresenter->presentCollection($supportRequestMessagesResponse);

        return $this->successResponse($presenter);
    }

    public function sendSupportRequestMessage(
        SendSupportRequestMessageAction $sendSupportRequestMessageAction,
        SupportRequestMessagesAsArrayPresenter $supportRequestMessagesAsArrayPresenter,
        SendSupportRequestMessageValidatorRequest $request): JsonResponse {

        $supportMessageResponse = $sendSupportRequestMessageAction->execute(new SendSupportRequestMessageRequest(
            $request->input('text'),
            $request->input('supportRequestId'),
            $request->input('supportRequestAuthorId'),
            $request->input('supportRequestSubjectId')
        ))
        ->getResponse();

        $presenter = $supportRequestMessagesAsArrayPresenter->present($supportMessageResponse);

        return $this->successResponse($presenter);
    }

    public function getSupportRequest(
        string $id,
        GetSupportRequestByIdAction $getSupportRequestByIdAction,
        SupportRequestAsArrayPresenter $supportRequestAsArrayPresenter
        ): JsonResponse {
        $supportRequest = $getSupportRequestByIdAction->execute(
            new GetSupportRequestByIdRequest(
                (int) $id
            )
        )->getResponse();

        $presenter = $supportRequestAsArrayPresenter->present($supportRequest);

        return response()->json($presenter);
    }

    public function updateSupportStatusRequest(
        UpdateSupportStatusAction $updateSupportRequestAction,
        SupportRequestAsArrayPresenter $supportRequestAsArrayPresenter,
        UpdateSupportRequestValidatorRequest $request
    ): JsonResponse {
        $supportRequest = $updateSupportRequestAction->execute(
            new UpdateSupportStatusRequest(
                (int) $request->requestId,
                (int) $request->requestStatusId,
            )
        )->getResponse();

        $presenter = $supportRequestAsArrayPresenter->present($supportRequest);

        return response()->json($presenter);
    }

    public function getSupportRequestsByCriteria(
        GetSupportRequestByCriteriaAction $updateSupportRequestAction,
        SupportRequestAsArrayPresenter $supportRequestAsArrayPresenter,
        GetSupportRequestsByCriteriaValidatorRequest $request
    ): JsonResponse {
        $supportRequest = $updateSupportRequestAction->execute(
            new GetSupportRequestCriteriaRequest(
                (int) $request->id,
                $request->startDate,
                $request->endDate,
                (int) $request->statusId,
                (int) $request->userId
            )
        )->getResponse();

        $presenter = $supportRequestAsArrayPresenter->presentCollection($supportRequest);

        return response()->json($presenter);
    }
}
