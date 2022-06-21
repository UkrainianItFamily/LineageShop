<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

use App\Exceptions\FinanceOperation\NotEnoughMoneyException;
use App\Models\FinanceOperationsHistory;
use App\Constant\FinanceOperationConstant;
use App\Repositories\FinanceOperation\FinanceOperationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class AddWriteOffsFinanceOperationAction
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

    public function execute(AddWriteOffsFinanceOperationRequest $request): AddWriteOffsFinanceOperationResponse
    {
        $user = $this->userRepository->getById(Auth::id());

        $balance = $user->getBalance() - $request->getMoney();

        if($balance < 0) {
            throw new NotEnoughMoneyException();
        }

        $newFinanceOperation = new FinanceOperationsHistory;
        $newFinanceOperation->money = $request->getMoney();
        $newFinanceOperation->type = FinanceOperationConstant::WRITE_OFFS;
        $newFinanceOperation->status = FinanceOperationConstant::EXECUTED;
        $newFinanceOperation->user_id = Auth::id();

        $this->financeOperationRepository->save($newFinanceOperation);

        $user->balance = $balance;
        $user->update();

        return new AddWriteOffsFinanceOperationResponse($newFinanceOperation);
    }
}
