<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceOperationsHistoriesTable extends Migration
{

    public function up()
    {
        Schema::create('finance_operations_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->integer('money');
            $table->integer('type');
            $table->integer('status');
            $table->foreignId('wallet_id')->nullable()->constrained('user_wallets', 'id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('finance_operations_histories');
    }
}
