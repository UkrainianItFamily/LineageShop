<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = DB::table('categories')->select('id', 'has_availability')->get();

        foreach ($categories as $category) {
            Product::factory(20)->create([
                'category_id' => $category->id,
                'availability' => $category->has_availability ? rand(1, 20) : 0,
            ]);
        }
    }
}
