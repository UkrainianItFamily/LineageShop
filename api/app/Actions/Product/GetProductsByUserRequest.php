<?php

declare(strict_types=1);

namespace App\Actions\Product;

final class GetProductsByUserRequest
{
    private ?int $userId;
    private ?int $categoryId;
    private ?string $orderType;
    private ?string $orderDirection;

    public function __construct(
        ?int $userId,
        ?int $categoryId,
        ?string $orderType,
        ?string $orderDirection
    ) {
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->orderType = $orderType;
        $this->orderDirection = $orderDirection;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    public function getOrderDirection(): ?string
    {
        return $this->orderDirection;
    }
}
