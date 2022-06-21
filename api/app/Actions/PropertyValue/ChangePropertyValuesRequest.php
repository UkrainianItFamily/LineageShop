<?php

declare(strict_types=1);

namespace App\Actions\PropertyValue;

final class ChangePropertyValuesRequest
{
    private int $productId;

    private array $properties;

    public function __construct(
        int $productId,
        array $properties
    ) {
        $this->productId = $productId;
        $this->properties = $properties;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }
}
