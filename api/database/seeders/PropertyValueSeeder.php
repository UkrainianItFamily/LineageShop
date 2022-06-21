<?php

namespace Database\Seeders;

use App\Models\PropertyValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyValueSeeder extends Seeder
{
    public function run()
    {
        $productList = DB::table('products')->get();

        foreach ($productList as $product){
            $propertyList = DB::table('properties')
                ->where('category_id', $product->category_id)
                ->get();

            if ($propertyList->count()){
                foreach ($propertyList as $property) {
                    if ($property->type === 0){
                        $propertyDefaultList = DB::table('property_default_values')
                            ->where('property_id', $property->id)
                            ->get('id');

                        $propertyDefaultCount = $propertyDefaultList->count();

                        PropertyValue::factory(1)
                            ->create([
                                'property_id' => $property->id,
                                'product_id' => $product->id,
                                'value_id' => $propertyDefaultList[rand(0,--$propertyDefaultCount)]->id
                            ]);
                    } else {
                        PropertyValue::factory(1)
                            ->create([
                                'property_id' => $property->id,
                                'product_id' => $product->id,
                                'value' => rand(1,120),
                            ]);
                    }
                }
            }

        }
    }
}
