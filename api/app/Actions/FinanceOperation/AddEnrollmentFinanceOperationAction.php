<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use App\Models\FinanceOperationsHistory;
use App\Constant\FinanceOperationConstant;
use App\Repositories\FinanceOperation\FinanceOperationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

final class AddEnrollmentFinanceOperationAction
{
    private FinanceOperationRepositoryInterface $financeOperationRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        FinanceOperationRepositoryInterface $financeOperationRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->financeOperationRepository = $financeOperationRepository;
        $this->userRepository = $userRepository;
    }

    public function execute(AddEnrollmentFinanceOperationRequest $request): AddEnrollmentFinanceOperationResponse
    {
        $newFinanceOperation = new FinanceOperationsHistory;

        $newFinanceOperation->money = $request->getMoney();
        $newFinanceOperation->type = FinanceOperationConstant::ENROLLMENT;
        $newFinanceOperation->status = FinanceOperationConstant::EXECUTED;
        $newFinanceOperation->user_id = $request->getSellerId();

        $newFinanceOperation = $this->financeOperationRepository->save($newFinanceOperation);

        $this->userRepository->incrementBalance(
            $request->getSellerId(),
            $request->getMoney()
        );

        return new AddEnrollmentFinanceOperationResponse($newFinanceOperation);
    }
}
