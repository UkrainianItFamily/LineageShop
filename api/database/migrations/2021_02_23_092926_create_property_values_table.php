<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyValuesTable extends Migration
{
    public function up()
    {
        Schema::create('property_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('property_id')->constrained('properties', 'id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products', 'id')->onDelete('cascade');
            $table->text('value')->nullable();
            $table->foreignId('value_id')->nullable()->constrained('property_default_values', 'id')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_values');
    }
}
