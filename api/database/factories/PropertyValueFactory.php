<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyValueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'value' => null,
            'value_id' => null,
        ];
    }
}
