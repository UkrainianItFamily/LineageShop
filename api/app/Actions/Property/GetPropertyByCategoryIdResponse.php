<?php

declare(strict_types=1);

namespace App\Actions\Property;

use App\Actions\Response;
use Illuminate\Support\Collection;

final class GetPropertyByCategoryIdResponse implements Response
{
    private Collection $propertyCollection;

    public function __construct(Collection $propertyCollection)
    {
        $this->propertyCollection = $propertyCollection;
    }

    public function getResponse(): Collection
    {
        return $this->propertyCollection;
    }
}
