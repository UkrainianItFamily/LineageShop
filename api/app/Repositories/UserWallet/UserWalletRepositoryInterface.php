<?php

namespace App\Repositories\UserWallet;

use App\Models\UserWallet;
use Illuminate\Database\Eloquent\Collection;

interface UserWalletRepositoryInterface
{
    public function save(UserWallet $newUserWallet): UserWallet;
    public function update(UserWallet $updateUserWallet): UserWallet;
    public function delete(UserWallet $deleteUserWallet): void;
    public function getById(int $id): ?UserWallet;
    public function findByCriteria(array $criteria): ?Collection;
}
