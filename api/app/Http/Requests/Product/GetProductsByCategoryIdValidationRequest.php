<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\ApiFormRequest;

class GetProductsByCategoryIdValidationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'categoryId' => 'required|integer|exists:App\Models\Category,id'
        ];
    }
}
