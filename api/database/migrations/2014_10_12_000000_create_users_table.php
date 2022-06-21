<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login');
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('license')->default(false);
            $table->string('user_photo')->nullable();
            $table->boolean('online')->default(false);
            $table->float('balance')->default(0);
            $table->boolean('confirm_send_email')->default(false);
            $table->boolean('password_reset_admin')->default(false);
            $table->foreignId('user_role_id')->nullable()->constrained('user_roles', 'id');
            $table->bigInteger('google_id')->nullable();
            $table->bigInteger('facebook_id')->nullable();
            $table->bigInteger('yandex_id')->nullable();
            $table->bigInteger('vkontakte_id')->nullable();
            $table->bigInteger('discord_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
