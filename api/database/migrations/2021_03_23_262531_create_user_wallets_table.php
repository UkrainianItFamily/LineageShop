<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWalletsTable extends Migration
{

    public function up()
    {
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('info');
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('wallet_type_id')->constrained('wallet_types', 'id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_wallets');
    }
}
