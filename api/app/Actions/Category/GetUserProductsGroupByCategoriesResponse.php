<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetUserProductsGroupByCategoriesResponse implements Response
{
    private Collection $categoriesWithProductsForUser;

    public function __construct(Collection $categoriesWithProductsForUser)
    {
        $this->categoriesWithProductsForUser = $categoriesWithProductsForUser;
    }

    public function getResponse(): Collection
    {
        return $this->categoriesWithProductsForUser;
    }
}
