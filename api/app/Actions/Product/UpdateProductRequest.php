<?php

declare(strict_types=1);

namespace App\Actions\Product;

final class UpdateProductRequest
{
    private int $id;

    private ?string $name;

    private ?string $description;

    private int $categoryId;

    private float $price;

    private int $active;

    private ?int $availability;

    private ?int $equipmentId;

    private ?int $level;

    private ?string $profession;

    private ?int $propertyId;

    private ?int $raceId;

    private ?int $rankId;

    private ?string $shortDescription;

    private ?int $subPropertyId;

    private ?int $typeId;

    public function __construct(
        int $id,
        ?string $name = null,
        ?string $description = null,
        int $categoryId = null,
        float $price = null,
        int $active = null,
        ?int $availability = null,
        ?int $equipmentId = null,
        ?int $level = null,
        ?string $profession = null,
        ?int $propertyId = null,
        ?int $raceId = null,
        ?int $rankId = null,
        ?string $shortDescription = null,
        ?int $subPropertyId = null,
        ?int $typeId = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->categoryId = $categoryId;
        $this->price = $price;
        $this->active = $active;
        $this->availability = $availability;
        $this->equipmentId = $equipmentId;
        $this->level = $level;
        $this->profession = $profession;
        $this->propertyId = $propertyId;
        $this->raceId = $raceId;
        $this->rankId = $rankId;
        $this->shortDescription = $shortDescription;
        $this->subPropertyId = $subPropertyId;
        $this->typeId = $typeId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function getAvailability(): ?int
    {
        return $this->availability;
    }

    public function getEquipmentId(): ?int
    {
        return $this->equipmentId;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function getPropertyId(): ?int
    {
        return $this->propertyId;
    }

    public function getRaceId(): ?int
    {
        return $this->raceId;
    }

    public function getRankId(): ?int
    {
        return $this->rankId;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function getSubPropertyId(): ?int
    {
        return $this->subPropertyId;
    }

    public function getTypeId(): ?int
    {
        return $this->typeId;
    }
}
