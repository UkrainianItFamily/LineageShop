<?php

declare(strict_types=1);

namespace App\Actions\UserWallet;

use App\Actions\Response;
use Illuminate\Support\Collection;

class GetUserWalletsForCurrentUserResponse implements Response
{
    private Collection $userWallets;

    public function __construct(Collection $userWallets)
    {
        $this->userWallets = $userWallets;
    }

    public function getResponse(): Collection
    {
        return $this->userWallets;
    }
}
