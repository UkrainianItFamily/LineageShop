<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use App\Constant\FinanceOperationConstant;
use App\Repositories\FinanceOperation\Criterion\FinanceOperationBetweenDateCriterion;
use App\Repositories\FinanceOperation\Criterion\FinanceOperationEndDateCriterion;
use App\Repositories\FinanceOperation\Criterion\FinanceOperationSortCriterion;
use App\Repositories\FinanceOperation\Criterion\FinanceOperationStatusCriterion;
use App\Repositories\FinanceOperation\FinanceOperationRepositoryInterface;
use App\Repositories\FinanceOperation\Criterion\FinanceOperationIdCriterion;
use App\Repositories\FinanceOperation\Criterion\FinanceOperationUserLoginCriterion;
use Carbon\Carbon;

final class GetAllFinanceOperationsAction
{
    private FinanceOperationRepositoryInterface $financeOperationRepositoryInterface;

    public function __construct(FinanceOperationRepositoryInterface $financeOperationRepositoryInterface)
    {
        $this->financeOperationRepositoryInterface = $financeOperationRepositoryInterface;
    }

    public function execute(GetAllFinanceOperationsRequest $request): GetAllFinanceOperationsResponse
    {
        $criteria = [];

        if ($request->getId()) {
            $criteria[] = new FinanceOperationIdCriterion($request->getId());
        }

        if ($request->getUserLogin()) {
            $criteria[] = new FinanceOperationUserLoginCriterion($request->getUserLogin());
        }

        if ($request->getStatusId()) {
            $criteria[] = new FinanceOperationStatusCriterion($request->getStatusId());
        }

        if($request->getStartDate()) {
            $startDate = Carbon::parse($request->getStartDate())->startOfDay()->toDateTimeString();
            $endDate = Carbon::parse($request->getEndDate())->endOfDay()->toDateTimeString();
            $criteria[] = new FinanceOperationBetweenDateCriterion($startDate, $endDate);
        }

        if($request->getEndDate() && !$request->getStartDate()) {
            $endDate = Carbon::parse($request->getEndDate())->endOfDay()->toDateTimeString();
            $criteria[] = new FinanceOperationEndDateCriterion($endDate);
        }

        if($request->getOrderType()) {
            $criteria[] = new FinanceOperationSortCriterion(
                $request->getOrderType(),
                $request->getOrderDirection()
            );
        } else {
            $criteria[] = new FinanceOperationSortCriterion(
                FinanceOperationConstant::DEFAULT_ORDER_TYPE,
                FinanceOperationConstant::DEFAULT_ORDER_DIRECTION
            );
        }

        $financeOperations = $this->financeOperationRepositoryInterface->findByCriteria($criteria);

        return new GetAllFinanceOperationsResponse($financeOperations);
    }
}
