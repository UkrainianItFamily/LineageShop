<?php

namespace App\Http\Presenters\SupportRequest;

use App\Constant\SupportRequestConstant;
use App\Models\SupportRequest;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

class SupportRequestAsArrayPresenter implements CollectionAsArrayPresenterInterface
{
    public function present(SupportRequest $supportRequest): array
    {
        $arrayResponse = [
            'id' => $supportRequest->getId(),
            'authorId' => $supportRequest->getAuthorId(),
            'subject' => [
                'id' => $supportRequest->getSubject(),
                'label' => SupportRequestConstant::SUBJECTS[$supportRequest->getSubject()]
            ],
            'login' => $supportRequest->getLogin(),
            'status' => [
                'id' => $supportRequest->getStatus(),
                'label' => SupportRequestConstant::StatusNames[$supportRequest->getStatus()]
            ],
            'order_id' => $supportRequest->getOrderId(),
            'createdAt' => $supportRequest->getCreatedAt(),
            'updatedAt' =>  $supportRequest->getUpdatedAt(),
            'email' => $supportRequest->getEmail()

        ];
        return $arrayResponse;
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (SupportRequest $supportRequest) {
                    return $this->present($supportRequest);
                }
            )
            ->all();
    }
}
