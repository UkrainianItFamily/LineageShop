<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Constant\PropertyConstant;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $defaultValue = PropertyConstant::DEFAULT_VALUE;
        $variableValue = PropertyConstant::VARIABLE_VALUE;
        $accounts = DB::table('categories')->where('name', '=', 'Аккаунты')->first()->id;
        $items = DB::table('categories')->where('name', '=', 'Предметы')->first()->id;
        $other = DB::table('categories')->where('name', '=', 'Прочее')->first()->id;
        $adena = DB::table('categories')->where('name', '=', 'Адена')->first()->id;
        $characterUpgrade = DB::table('categories')->where('name', '=', 'Прокачка')->first()->id;

        DB::table('properties')->insert(['name' => 'Раса', 'type' => $defaultValue, 'category_id' => $accounts, 'input_name' => 'race']);
        DB::table('properties')->insert(['name' => 'Экипировка', 'type' => $defaultValue, 'category_id' => $accounts, 'input_name' => 'equipment']);
        DB::table('properties')->insert(['name' => 'Уровень', 'type' => $variableValue, 'category_id' => $accounts, 'input_name' => 'level']);
        DB::table('properties')->insert(['name' => 'Профессия', 'type' => $variableValue, 'category_id' => $accounts, 'sortable' => false, 'input_name' => 'profession']);
        DB::table('properties')->insert(['name' => 'Краткое описание', 'type' => $variableValue, 'category_id' => $accounts, 'sortable' => false, 'input_name' => 'shortDescription']);
        DB::table('properties')->insert(['name' => 'Цена', 'type' => $variableValue, 'category_id' => $accounts, 'sortable' => false, 'input_name' => 'price', 'display_in_product_list' => 1]);
        DB::table('properties')->insert(['name' => 'Ранг', 'type' => $defaultValue, 'category_id' => $items, 'input_name' => 'rank']);
        DB::table('properties')->insert(['name' => 'Тип', 'type' => $defaultValue, 'category_id' => $other, 'input_name' => 'type']);
        DB::table('properties')->insert(['name' => 'Категория', 'type' => $defaultValue, 'category_id' => $items, 'input_name' => 'property']);
        DB::table('properties')->insert(['name' => 'Название', 'type' => $variableValue, 'category_id' => $items, 'sortable' => false, 'input_name' => 'title']);
        DB::table('properties')->insert(['name' => 'Краткое описание', 'type' => $variableValue, 'category_id' => $other, 'sortable' => false, 'input_name' => 'shortDescription']);
        DB::table('properties')->insert(['name' => 'Подробное описание', 'type' => $variableValue, 'category_id' => $other, 'sortable' => false, 'input_name' => 'description']);
        DB::table('properties')->insert(['name' => 'Краткое описание', 'type' => $variableValue, 'category_id' => $characterUpgrade, 'sortable' => false, 'input_name' => 'shortDescription']);
        DB::table('properties')->insert(['name' => 'Подробное описание', 'type' => $variableValue, 'category_id' => $characterUpgrade, 'sortable' => false, 'input_name' => 'description']);
        DB::table('properties')->insert(['name' => 'Цена', 'type' => $variableValue, 'category_id' => $characterUpgrade, 'sortable' => false, 'input_name' => 'price', 'display_in_product_list' => 1]);
        DB::table('properties')->insert(['name' => 'Цена', 'type' => $variableValue, 'category_id' => $items, 'sortable' => false, 'input_name' => 'price', 'display_in_product_list' => 1]);
        DB::table('properties')->insert(['name' => 'Цена', 'type' => $variableValue, 'category_id' => $other, 'sortable' => false, 'input_name' => 'price', 'display_in_product_list' => 1]);
        DB::table('properties')->insert(['name' => 'Наличие', 'type' => $variableValue, 'category_id' => $items, 'sortable' => false, 'input_name' => 'availability', 'display_in_product_list' => 1]);
        DB::table('properties')->insert(['name' => 'Цена', 'type' => $variableValue, 'category_id' => $adena, 'sortable' => false, 'input_name' => 'price', 'display_in_product_list' => 1]);
        DB::table('properties')->insert(['name' => 'Наличие', 'type' => $variableValue, 'category_id' => $adena, 'sortable' => false, 'input_name' => 'availability', 'display_in_product_list' => 1]);

        $propertyCategoryId = DB::table('properties')->where('name', '=', 'Категория')->first()->id;

        DB::table('properties')->insert(['name' => 'Оружие', 'type' => $defaultValue, 'parent_id' => $propertyCategoryId, 'input_name' => 'subProperty', 'parent_value_id' => null]);
        DB::table('properties')->insert(['name' => 'Доспехи', 'type' => $defaultValue, 'parent_id' => $propertyCategoryId, 'input_name' => 'subProperty', 'parent_value_id' => null]);
        DB::table('properties')->insert(['name' => 'Аксессуары', 'type' => $defaultValue, 'parent_id' => $propertyCategoryId, 'input_name' => 'subProperty', 'parent_value_id' => null]);
    }
}
