<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use Auth;
use App\Repositories\FinanceOperation\FinanceOperationRepositoryInterface;
use App\Repositories\FinanceOperation\Criterion\FinanceOperationTypeCriterion;
use App\Repositories\FinanceOperation\Criterion\FinanceOperationUserIdCriterion;

final class GetFinanceOperationsForCurrentUserAction
{
    private FinanceOperationRepositoryInterface $financeOperationRepository;

    public function __construct(FinanceOperationRepositoryInterface $financeOperationRepository)
    {
        $this->financeOperationRepository = $financeOperationRepository;
    }

    public function execute(GetFinanceOperationsForCurrentUserRequest $request): GetFinanceOperationsForCurrentUserResponse
    {
        $criteria[] = new FinanceOperationUserIdCriterion(Auth::id());

        if ($request->getFinanceOperationTypeId()) {
            $criteria[] = new FinanceOperationTypeCriterion($request->getFinanceOperationTypeId());
        }

        $financeOperations = $this->financeOperationRepository->findByCriteria($criteria);

        return new GetFinanceOperationsForCurrentUserResponse($financeOperations);
    }
}
