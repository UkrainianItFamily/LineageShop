<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDefaultValuesTable extends Migration
{
    public function up()
    {
        Schema::create('property_default_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('property_id')->constrained('properties', 'id')->onDelete('cascade');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_default_values');
    }
}
