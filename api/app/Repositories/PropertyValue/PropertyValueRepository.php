<?php

declare(strict_types=1);

namespace App\Repositories\PropertyValue;

use App\Models\PropertyValue;
use App\Repositories\BaseRepository;

class PropertyValueRepository extends BaseRepository
{
    public function save(PropertyValue $propertyValue): PropertyValue
    {
        $propertyValue->save();

        return $propertyValue;
    }
}
