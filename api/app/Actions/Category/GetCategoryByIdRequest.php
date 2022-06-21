<?php

declare(strict_types=1);

namespace App\Actions\Category;

final class GetCategoryByIdRequest
{
    private int $categoryId;

    public function __construct(
         int $categoryId
    ) {
        $this->categoryId = $categoryId;
    }

    public function getId(): int
    {
        return $this->categoryId;
    }
}
