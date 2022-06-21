<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::factory(1)->create([
            'name' => 'Адена', 'slug' => 'adena',
            'has_nickname_in_order' => true,
            'has_amount_currency_in_order' => true,
            'has_availability' => true,
            'sell_button_name' => 'Продать игровую валюту',
        ]);
        Category::factory(1)->create([
            'name' => 'Аккаунты',
            'slug' => 'accounts',
            'sell_button_name' => 'Продать аккаунты',
        ]);
        Category::factory(1)->create([
            'name' => 'Предметы',
            'slug' => 'items',
            'has_nickname_in_order' => true,
            'has_availability' => true,
            'sell_button_name' => 'Продать предметы',
        ]);
        Category::factory(1)->create([
            'name' => 'Прокачка',
            'slug' => 'character-upgrade',
            'sell_button_name' => 'Продать прокачку',
        ]);
        Category::factory(1)->create([
            'name' => 'Прочее',
            'slug' => 'other',
            'sell_button_name' => 'Продать прочее',
        ]);
    }
}
