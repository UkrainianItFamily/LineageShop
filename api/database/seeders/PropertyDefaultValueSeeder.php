<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyDefaultValueSeeder extends Seeder
{
    public function run()
    {
        $raceId = DB::table('properties')->where('name', '=', 'Раса')->first()->id;
        $equipmentId = DB::table('properties')->where('name', '=', 'Экипировка')->first()->id;
        $categoryId = DB::table('properties')->where('name', '=', 'Категория')->first()->id;
        $rankId = DB::table('properties')->where('name', '=', 'Ранг')->first()->id;
        $typeId = DB::table('properties')->where('name', '=', 'Тип')->first()->id;

        $weaponId = DB::table('properties')->where('name', '=', 'Оружие')->first()->id;
        $armorId = DB::table('properties')->where('name', '=', 'Доспехи')->first()->id;
        $accessoryId = DB::table('properties')->where('name', '=', 'Аксессуары')->first()->id;

        // Раса
        DB::table('property_default_values')->insert(['property_id' => $raceId, 'value' => 'Люди']);
        DB::table('property_default_values')->insert(['property_id' => $raceId, 'value' => 'Эльфы']);
        DB::table('property_default_values')->insert(['property_id' => $raceId, 'value' => 'Темные Эльфы']);
        DB::table('property_default_values')->insert(['property_id' => $raceId, 'value' => 'Орки']);
        DB::table('property_default_values')->insert(['property_id' => $raceId, 'value' => 'Гномы']);
        DB::table('property_default_values')->insert(['property_id' => $raceId, 'value' => 'Камаэль']);
        DB::table('property_default_values')->insert(['property_id' => $raceId, 'value' => 'Артея']);

        // Экипировка
        DB::table('property_default_values')->insert(['property_id' => $equipmentId, 'value' => 'Голый']);
        DB::table('property_default_values')->insert(['property_id' => $equipmentId, 'value' => 'Одетый']);

        // Категория
        DB::table('property_default_values')->insert(['property_id' => $categoryId, 'value' => 'Наборы (сеты)']);
        DB::table('property_default_values')->insert(['property_id' => $categoryId, 'value' => 'Припасы']);
        DB::table('property_default_values')->insert(['property_id' => $categoryId, 'value' => 'Предметы питомца']);
        DB::table('property_default_values')->insert(['property_id' => $categoryId, 'value' => 'Брошки, камни Лавианроз']);
        DB::table('property_default_values')->insert(['property_id' => $categoryId, 'value' => 'Прочее']);
        DB::table('property_default_values')->insert(['property_id' => $categoryId, 'value' => 'Оружие']);
        DB::table('property_default_values')->insert(['property_id' => $categoryId, 'value' => 'Доспехи']);
        DB::table('property_default_values')->insert(['property_id' => $categoryId, 'value' => 'Аксессуары']);

        $weaponCategoryId = DB::table('property_default_values')->where('value', '=', 'Оружие')->first()->id;
        $armorCategoryId = DB::table('property_default_values')->where('value', '=', 'Доспехи')->first()->id;
        $accessoryCategoryId = DB::table('property_default_values')->where('value', '=', 'Аксессуары')->first()->id;
        DB::table('properties')->where('name', '=', 'Оружие')->update(['parent_value_id' => $weaponCategoryId]);
        DB::table('properties')->where('name', '=', 'Доспехи')->update(['parent_value_id' => $armorCategoryId]);
        DB::table('properties')->where('name', '=', 'Аксессуары')->update(['parent_value_id' => $accessoryCategoryId]);


        // Оружие
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Одноручный меч']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Одноручный маг. меч']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Кинжал']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Рапира']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Двуручный меч']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Древний меч']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Парные мечи']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Парные кинжалы']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Одноручное дробящее']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Одноручное маг. дробящее']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Двуручное дробящее']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Двуручное маг. дробящее']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Парное дробящее']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Лук']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Арбалет']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Кастеты']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Древковое']);
        DB::table('property_default_values')->insert(['property_id' => $weaponId, 'value' => 'Другое оружие']);

        // Доспехи
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Шлем']);
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Верхняя часть доспехов']);
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Нижняя часть доспехов']);
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Полный доспех']);
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Перчатки']);
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Обувь']);
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Щит']);
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Символ']);
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Нижнее белье']);
        DB::table('property_default_values')->insert(['property_id' => $armorId, 'value' => 'Плащ']);

        // Аксессуары
        DB::table('property_default_values')->insert(['property_id' => $accessoryId, 'value' => 'Кольцо']);
        DB::table('property_default_values')->insert(['property_id' => $accessoryId, 'value' => 'Серьга']);
        DB::table('property_default_values')->insert(['property_id' => $accessoryId, 'value' => 'Ожерелье']);
        DB::table('property_default_values')->insert(['property_id' => $accessoryId, 'value' => 'Пояс']);
        DB::table('property_default_values')->insert(['property_id' => $accessoryId, 'value' => 'Браслет']);
        DB::table('property_default_values')->insert(['property_id' => $accessoryId, 'value' => 'Головной убор']);

        // Ранг
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value' => 'Без ранга']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'D']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'C']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'B']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'A']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'S']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'S80']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'R']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'R95']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'R99']);
        DB::table('property_default_values')->insert(['property_id' => $rankId, 'value'  => 'R110']);

        // Тип
        DB::table('property_default_values')->insert(['property_id' => $typeId, 'value'  => 'Квесты']);
        DB::table('property_default_values')->insert(['property_id' => $typeId, 'value'  => 'Фарм олимпа']);
        DB::table('property_default_values')->insert(['property_id' => $typeId, 'value'  => 'Прочее']);
    }
}
