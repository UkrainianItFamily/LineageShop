<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Models\Category;
use App\Actions\Response;

final class GetCategoryByIdResponse implements Response
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getResponse(): Category
    {
        return $this->category;
    }
}
