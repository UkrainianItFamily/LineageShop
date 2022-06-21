<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('user_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('user_customer_id')->constrained('users', 'id');
            $table->integer('rating')->nullable();
            $table->text('text');
            $table->foreignId('order_id')->constrained('orders', 'id')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_ratings');
    }
}
