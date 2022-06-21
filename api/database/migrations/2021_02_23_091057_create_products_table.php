<?php

use App\Constant\ProductConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories', 'id')->onDelete('cascade');
            $table->foreignId('property_id')->nullable()->constrained('properties', 'id')->onDelete('cascade');
            $table->foreignId('sub_property_id')->nullable()->constrained('property_default_values', 'id')->onDelete('cascade');
            $table->float('price');
            $table->integer('refresh_time')->nullable();
            $table->boolean('active')->default(0);
            $table->integer('availability')->nullable();
            $table->foreignId('rank_id')->nullable()->constrained('property_default_values', 'id')->onDelete('cascade');
            $table->foreignId('race_id')->nullable()->constrained('property_default_values', 'id')->onDelete('cascade');
            $table->foreignId('type_id')->nullable()->constrained('property_default_values', 'id')->onDelete('cascade');
            $table->integer('sale_status')->default(ProductConstant::NOT_SOLD);
            $table->integer('level')->nullable();
            $table->integer('equipment_id')->nullable();
            $table->string('profession')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
