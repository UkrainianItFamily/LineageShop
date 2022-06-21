<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function save(User $user): User
    {
        $user->save();

        return $user;
    }

    public function update(User $user): User
    {
        $user->update();

        return $user;
    }

    public function getAll(): Collection
    {
        return User::all();
    }

    public function getById(int $id): ?User
    {
        return User::firstWhere('id', $id);
    }

    public function getByEmail(string $email): ?User
    {
        return User::firstWhere('email', $email);
    }

    public function markUserEmail(User $user): void
    {
        $user->markEmailAsVerified();
    }

    public function updateOrCreateUserByProvider(
        string $column,
        int    $providerId,
        array  $userParams
    ): User
    {
        return User::firstOrCreate([$column => $providerId], $userParams);
    }

    public function incrementBalance(int $userId, float $money)
    {
        return User::firstWhere('id', $userId)->increment('balance', $money);
    }
}
