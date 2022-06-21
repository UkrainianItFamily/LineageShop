<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use App\Exceptions\FinanceOperation\FinanceOperationNotFoundException;
use App\Repositories\FinanceOperation\FinanceOperationRepositoryInterface;

final class GetFinanceOperationByIdAction
{
    private FinanceOperationRepositoryInterface $financeOperationRepository;

    public function __construct(FinanceOperationRepositoryInterface $financeOperationRepository)
    {
        $this->financeOperationRepository = $financeOperationRepository;
    }

    public function execute(GetFinanceOperationByIdRequest $request): GetFinanceOperationByIdResponse
    {
        $financeOperation = $this->financeOperationRepository->getById($request->getId());

        if (!$financeOperation) {
            throw new FinanceOperationNotFoundException();
        }
        return new GetFinanceOperationByIdResponse($financeOperation);
    }
}
