<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('input_name');
            $table->integer('type');
            $table->integer('parent_value_id')->nullable();
            $table->boolean('display_in_product_list')->default(0);
            $table->foreignId('category_id')->nullable()->constrained('categories', 'id')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('properties', 'id')->onDelete('cascade');
            $table->boolean('sortable')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
