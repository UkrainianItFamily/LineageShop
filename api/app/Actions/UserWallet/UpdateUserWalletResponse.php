<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

use App\Actions\Response;
use App\Models\UserWallet;

final class UpdateUserWalletResponse implements Response
{
    private UserWallet $userWallet;

    public function __construct(UserWallet $userWallet)
    {
        $this->userWallet = $userWallet;
    }

    public function getResponse(): UserWallet
    {
        return $this->userWallet;
    }
}
