<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use App\Exceptions\FinanceOperation\NotEnoughMoneyException;
use App\Repositories\FinanceOperation\Criterion\FinanceOperationUserIdCriterion;
use Auth;
use App\Models\FinanceOperationsHistory;
use App\Constant\FinanceOperationConstant;
use App\Repositories\FinanceOperation\FinanceOperationRepositoryInterface;

final class AddFinanceOperationAction
{
    private FinanceOperationRepositoryInterface $financeOperationRepository;

    public function __construct(FinanceOperationRepositoryInterface $financeOperationRepository)
    {
        $this->financeOperationRepository = $financeOperationRepository;
    }

    public function execute(AddFinanceOperationRequest $request): AddFinanceOperationResponse
    {
        $criteria = [
            new FinanceOperationUserIdCriterion(
               Auth::id()
            )
        ];

        $userFinanceOperations = $this->financeOperationRepository->findByCriteria($criteria);

        $writeOffsSum = $userFinanceOperations
            ->where('type', FinanceOperationConstant::WRITE_OFFS)
            ->where('status', FinanceOperationConstant::EXECUTED)
            ->sum('money');

        $enrollmentsSum = $userFinanceOperations
            ->where('type', FinanceOperationConstant::ENROLLMENT)
            ->where('status', FinanceOperationConstant::EXECUTED)
            ->sum('money');

        $balance = ($enrollmentsSum - $writeOffsSum) - $request->getMoney();

        if($balance < 0) {
            throw new NotEnoughMoneyException();
        }

        $newFinanceOperation = new FinanceOperationsHistory;

        $newFinanceOperation->money = $request->getMoney();
        $newFinanceOperation->wallet_id = $request->getWalletId();
        $newFinanceOperation->type = $request->getType();
        $newFinanceOperation->status = FinanceOperationConstant::CREATED;
        $newFinanceOperation->user_id = Auth::id();

        $newFinanceOperation = $this->financeOperationRepository->save($newFinanceOperation);

        return new AddFinanceOperationResponse($newFinanceOperation);
    }
}
