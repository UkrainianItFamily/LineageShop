<?php

declare(strict_types=1);

namespace App\Actions\WalletType;

use App\Repositories\WalletType\WalletTypeRepository;

final class GetWalletTypesAction
{
    private WalletTypeRepository $walletTypeRepository;

    public function __construct(WalletTypeRepository $walletTypeRepository)
    {
        $this->walletTypeRepository = $walletTypeRepository;
    }

    public function execute(): GetWalletTypesResponse
    {
        $walletTypes = $this->walletTypeRepository->getAll();

        return new GetWalletTypesResponse($walletTypes);
    }
}
