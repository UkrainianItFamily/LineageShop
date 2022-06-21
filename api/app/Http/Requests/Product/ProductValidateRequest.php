<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\ApiFormRequest;

class ProductValidateRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|min:2|max:200|nullable',
            'description' => 'string|min:2|max:500|nullable',
            'categoryId' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric',
            'active' => 'required|boolean',
            'availability' => 'integer|nullable',
            'equipmentId' => 'integer|exists:property_default_values,id|nullable',
            'level' => 'integer|nullable',
            'profession' =>'string|min:2|max:150|nullable',
            'propertyId' => 'integer|exists:properties,id|nullable',
            'raceId' => 'integer|exists:property_default_values,id|nullable',
            'rankId' => 'integer|exists:property_default_values,id|nullable',
            'shortDescription' =>'string|min:2|max:500|nullable',
            'subPropertyId' => 'integer|exists:property_default_values,id|nullable',
            'typeId' => 'integer|exists:property_default_values,id|nullable',
        ];
    }
}
