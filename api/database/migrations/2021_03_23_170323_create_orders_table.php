<?php

use App\Constant\OrderConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')->constrained('products', 'id');
            $table->foreignId('user_customer_id')->constrained('users', 'id');
            $table->foreignId('user_seller_id')->constrained('users', 'id');
            $table->foreignId('wallet_type_id')->constrained('wallet_types', 'id');
            $table->integer('ship_type');
            $table->integer('status');
            $table->string('nickname')->nullable();
            $table->integer('quantity')->default(OrderConstant::MIN_QUANTITY);
            $table->integer('amount_currency')->nullable();
            $table->float('order_price');
            $table->dateTime('date_open');
            $table->dateTime('date_close')->default(null)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

