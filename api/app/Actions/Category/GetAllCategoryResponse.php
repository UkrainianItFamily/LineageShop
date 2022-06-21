<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetAllCategoryResponse implements Response
{
    private $categoryCollection;

    public function __construct(Collection $categoryCollection)
    {
        $this->categoryCollection = $categoryCollection;
    }

    public function getResponse(): Collection
    {
        return $this->categoryCollection;
    }
}
