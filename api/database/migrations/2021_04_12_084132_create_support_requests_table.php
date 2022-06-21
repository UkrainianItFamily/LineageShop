<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('support_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('text');
            $table->integer('subject')->nullable();
            $table->string('login');
            $table->string('email');
            $table->foreignId('author_id')->constrained('users', 'id');
            $table->integer('status')->nullable();
            $table->foreignId('order_id')->nullable()->constrained('orders', 'id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('support_requests');
    }
}
