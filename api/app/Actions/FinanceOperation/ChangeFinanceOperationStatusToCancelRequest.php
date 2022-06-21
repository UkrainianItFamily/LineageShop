<?php

declare(strict_types=1);

namespace App\Actions\FinanceOperation;

final class ChangeFinanceOperationStatusToCancelRequest
{
    private int $id;
    private string $canceledInfo;

    public function __construct(
        int $id,
        string $canceledInfo
    ) {
        $this->id = $id;
        $this->canceledInfo = $canceledInfo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCanceledInfo(): string
    {
        return $this->canceledInfo;
    }
}
