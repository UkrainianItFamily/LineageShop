<?php

namespace App\Repositories\Property;

use App\Models\Property;
use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;

class PropertyRepository extends BaseRepository
{
    public function getPropertyByCategoryId(int $categoryId): Collection
    {
        return Property::where('category_id', '=', $categoryId)->get();
    }
}
