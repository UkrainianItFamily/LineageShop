<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Constant\DefaultConstant;
use Illuminate\Support\Facades\DB;
use App\Constant\UserRoleConstant;

class UserSeeder extends Seeder
{
    public function run()
    {
        $registeredRole = DB::table('user_roles')
            ->where('type', '=', UserRoleConstant::REGISTERED)
            ->first()->id;

        $adminRole = DB::table('user_roles')
            ->where('type', '=', UserRoleConstant::ADMINISTRATOR)
            ->first()->id;

        DB::table('users')->insert([
            'login' => 'test',
            'password' => bcrypt('testtest'),
            'email' => 'test@test.com',
            'license' => DefaultConstant::TRUE,
            'user_photo' => null,
            'online' => DefaultConstant::TRUE,
            'confirm_send_email' => DefaultConstant::TRUE,
            'created_at' => Carbon::now(),
            'user_role_id' => $adminRole,
        ]);

        User::factory(10)->create([
            'user_role_id' => $registeredRole,
        ]);
    }
}
