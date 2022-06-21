<?php

declare(strict_types=1);

namespace App\Repositories\SupportRequest;

use App\Models\SupportRequest;
use Illuminate\Support\Collection;


interface SupportRequestRepositoryInterface
{
    public function save(SupportRequest $supportRequest): SupportRequest;
    public function getAll(): Collection;
    public function getSupportRequestById(int $id): SupportRequest;
    public function findByCriteria(array $criteria): Collection;
    public function updateSupportStatus(int $supportId, int $statusId): bool;
}
