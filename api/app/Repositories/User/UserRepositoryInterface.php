<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function save(User $user): User;
    public function update(User $user): User;
    public function getAll(): Collection;
    public function getById(int $id): ?User;
    public function getByEmail(string $email): ?User;
    public function markUserEmail(User $user): void;
    public function incrementBalance(int $userId, float $money);
    public function updateOrCreateUserByProvider(
        string $column,
        int $providerId,
        array $userParams
    ): User;
}
