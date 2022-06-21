<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

use App\Repositories\SupportRequest\Criterion\AuthorIdCriterion;
use App\Repositories\SupportRequest\Criterion\EndDateCriterion;
use App\Repositories\SupportRequest\Criterion\BetweenDateCriterion;
use App\Repositories\SupportRequest\Criterion\StatusCriterion;
use App\Repositories\SupportRequest\Criterion\SupportIdCriterion;
use App\Repositories\SupportRequest\SupportRequestRepositoryInterface;
use Carbon\Carbon;

final class GetSupportRequestByCriteriaAction
{
    private SupportRequestRepositoryInterface $supportRepository;

    public function __construct(SupportRequestRepositoryInterface $supportRepository)
    {
        $this->supportRepository = $supportRepository;
    }

    public function execute(GetSupportRequestCriteriaRequest $request): GetSupportRequestByCriteriaResponse
    {
        $criteria = [];

        if($request->getSupportRequestId()) {
            $criteria[] = new SupportIdCriterion($request->getSupportRequestId());
        }

        if($request->getStartDate()) {
            $startDate = Carbon::parse($request->getStartDate())->startOfDay()->toDateTimeString();
            $endDate = Carbon::parse($request->getEndDate())->endOfDay()->toDateTimeString();
            $criteria[] = new BetweenDateCriterion($startDate, $endDate);
        }

        if($request->getEndDate() && !$request->getStartDate()) {
            $endDate = Carbon::parse($request->getEndDate())->endOfDay()->toDateTimeString();
            $criteria[] = new EndDateCriterion($endDate);
        }

        if($request->getStatusId()) {
            $criteria[] = new StatusCriterion($request->getStatusId());
        }

        if($request->getUserId()) {
            $criteria[] = new AuthorIdCriterion($request->getUserId());
        }

        $supportRequest = $this->supportRepository->findByCriteria($criteria);

        return new GetSupportRequestByCriteriaResponse($supportRequest);
    }
}
