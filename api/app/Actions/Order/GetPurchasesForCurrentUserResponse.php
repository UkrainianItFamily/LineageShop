<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetPurchasesForCurrentUserResponse implements Response
{
    private ?Collection $orders;

    public function __construct(?Collection $orders)
    {
        $this->orders = $orders;
    }

    public function getResponse(): ?Collection
    {
        return $this->orders;
    }
}
