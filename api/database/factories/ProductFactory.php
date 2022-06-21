<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->realText(),
            'user_id' => rand(1, 10),
            'price' => rand(99, 1000),
            'refresh_time' => rand(0, 100),
            'active' => rand(0, 1),
        ];
    }
}
