<?php

declare(strict_types=1);

namespace App\Actions\WalletType;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetWalletTypesResponse implements Response
{
    private Collection $walletTypes;

    public function __construct(Collection $walletTypes)
    {
        $this->walletTypes = $walletTypes;
    }

    public function getResponse(): Collection
    {
        return $this->walletTypes;
    }
}
