<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTypesTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('wallet_symbol');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_types');
    }
}
