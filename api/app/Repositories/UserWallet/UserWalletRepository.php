<?php

declare(strict_types=1);

namespace App\Repositories\UserWallet;

use App\Models\UserWallet;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class UserWalletRepository extends BaseRepository implements UserWalletRepositoryInterface
{
    public function save(UserWallet $newUserWallet): UserWallet
    {
        $newUserWallet->save();

        return $newUserWallet;
    }
    public function update(UserWallet $updateUserWallet): UserWallet
    {
        $updateUserWallet->update();

        return $updateUserWallet;
    }
    public function delete(UserWallet $deleteUserWallet): void
    {
        $deleteUserWallet->delete();
    }

    public function getById(int $id): ?UserWallet
    {
        return UserWallet::firstWhere('id', $id);
    }

    public function findByCriteria(
        array $criteria
    ): ?Collection {
        $query = UserWallet::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query->get();
    }
}
