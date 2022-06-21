<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use App\Constant\FinanceOperationConstant;
use App\Exceptions\FinanceOperation\FinanceOperationNotFoundException;
use App\Repositories\FinanceOperation\FinanceOperationRepositoryInterface;
use App\Exceptions\FinanceOperation\FinanceOperationCannotBeCanceledException;
use Carbon\Carbon;

final class ChangeFinanceOperationStatusToCancelAction
{
    private FinanceOperationRepositoryInterface $financeOperationRepository;

    public function __construct(FinanceOperationRepositoryInterface $financeOperationRepository)
    {
        $this->financeOperationRepository = $financeOperationRepository;
    }

    public function execute(ChangeFinanceOperationStatusToCancelRequest $request): ChangeFinanceOperationStatusToCancelResponse
    {
        $financeOperation = $this->financeOperationRepository->getById($request->getId());

        if (!$financeOperation) {
            throw new FinanceOperationNotFoundException();
        }

        if ($financeOperation->getStatus() === FinanceOperationConstant::EXECUTED
        ) {
            throw new FinanceOperationCannotBeCanceledException();
        }

        $financeOperation->status = FinanceOperationConstant::CANCELED;
        $financeOperation->canceled_at = Carbon::now()->toDateTimeString();
        $financeOperation->canceled_info = $request->getCanceledInfo();

        $financeOperation = $this->financeOperationRepository->save($financeOperation);

        return new ChangeFinanceOperationStatusToCancelResponse($financeOperation);
    }
}
