<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use Auth;
use App\Exceptions\User\UserNotAuthorizedException;
use App\Exceptions\FinanceOperation\FinanceOperationNotFoundException;
use App\Repositories\FinanceOperation\FinanceOperationRepositoryInterface;

final class ChangeFinanceOperationStatusAction
{
    private FinanceOperationRepositoryInterface $financeOperationRepositoryInterface;

    public function __construct(FinanceOperationRepositoryInterface $financeOperationRepositoryInterface)
    {
        $this->financeOperationRepositoryInterface = $financeOperationRepositoryInterface;
    }

    public function execute(ChangeFinanceOperationStatusRequest $request): ChangeFinanceOperationStatusResponse
    {
        $financeOperation = $this->financeOperationRepositoryInterface->getById($request->getId());

        if (!$financeOperation) {
            throw new FinanceOperationNotFoundException();
        }

        $financeOperation->status = $request->getStatus();

        $this->financeOperationRepositoryInterface->update($financeOperation);

        return new ChangeFinanceOperationStatusResponse($financeOperation);
    }
}
