<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('wallet_types')->insert(['name' => 'QIWI', 'wallet_symbol' => '₽']);
        DB::table('wallet_types')->insert(['name' => 'ЮMoney', 'wallet_symbol' => '₽']);
        DB::table('wallet_types')->insert(['name' => 'Банковская карта', 'wallet_symbol' => '₽']);
        DB::table('wallet_types')->insert(['name' => 'WebMoney WMZ', 'wallet_symbol' => 'WMZ']);
        DB::table('wallet_types')->insert(['name' => 'WebMoney WME', 'wallet_symbol' => 'WME']);
        DB::table('wallet_types')->insert(['name' => 'Личный баланс', 'wallet_symbol' => '₽']);
    }
}
