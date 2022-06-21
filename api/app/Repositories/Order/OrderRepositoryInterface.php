<?php

declare(strict_types=1);

namespace App\Repositories\Order;

use App\Models\Order;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function save(Order $order): Order;
    public function update(Order $order): Order;
    public function findByCriteria(array $criteria): Collection;
    public function getById(int $id): ?Order;
    public function getByUserCustomerId(int $userCustomerId): ?Collection;
    public function getByUserSellerId(int $userSellerId): ?Collection;
}
