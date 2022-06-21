<?php

declare(strict_types=1);

namespace App\Actions\Product;

final class GetProductsByCategoryRequest
{
    private int $categoryId;
    private ?string $name;
    private ?string $page;
    private ?string $orderType;
    private ?string $orderDirection;
    private ?array $properties;

    public function __construct(
        int $categoryId,
        ?string $name = null,
        ?string $page = null,
        ?string $orderType = null,

        ?string $orderDirection = null,
        ?array $properties = null
    ) {
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->page = $page;
        $this->orderType = $orderType;
        $this->orderDirection = $orderDirection;
        $this->properties = $properties;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPage(): ?string
    {
        return $this->page;
    }

    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    public function getOrderDirection(): ?string
    {
        return $this->orderDirection;
    }

    public function getProperties(): ?array
    {
        return $this->properties;
    }
}
