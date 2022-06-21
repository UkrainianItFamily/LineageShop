<?php

declare(strict_types=1);

namespace App\Actions\Order;

final class ChangeOrderStatusRequest
{
    private int $id;
    private int $status;

    public function __construct(
        int $id,
        int $status
    ) {
        $this->id = $id;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
