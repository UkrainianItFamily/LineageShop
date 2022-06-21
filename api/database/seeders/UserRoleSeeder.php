<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Constant\UserRoleConstant;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_roles')->insert(['type' => UserRoleConstant::REGISTERED]);
        DB::table('user_roles')->insert(['type' => UserRoleConstant::ADMINISTRATOR]);
        DB::table('user_roles')->insert(['type' => UserRoleConstant::SUPER_ADMINISTRATOR]);
    }
}
