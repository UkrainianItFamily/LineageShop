<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('sell_button_name');
            $table->string('main_image');
            $table->string('second_image');
            $table->text('description');
            $table->boolean('has_nickname_in_order')->default(false);
            $table->boolean('has_amount_currency_in_order')->default(false);
            $table->boolean('has_availability')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
