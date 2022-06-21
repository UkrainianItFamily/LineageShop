<?php

declare(strict_types=1);

namespace App\Repositories\WalletType;

use App\Models\WalletType;
use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;

class WalletTypeRepository extends BaseRepository
{
    public function getAll(): Collection
    {
        return WalletType::all();
    }
}
