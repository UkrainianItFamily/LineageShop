<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WalletTypeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(PropertyDefaultValueSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(PropertyValueSeeder::class);
    }
}
