<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Repositories\Category\CategoryRepositoryInterface;

final class GetAllCategoryAction
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(): GetAllCategoryResponse
    {
        $categoryCollection = $this->categoryRepository->getAll();

        return new GetAllCategoryResponse($categoryCollection);
    }
}
