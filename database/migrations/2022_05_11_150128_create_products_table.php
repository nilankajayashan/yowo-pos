<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('product_id')->autoIncrement();
            $table->string('model');
            $table->string('bar_code')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('name');
            $table->text('description');
            $table->integer('quantity')->default(0);
            $table->integer('unit_price')->default(0);
            $table->integer('weight')->default(0);
            $table->string('main_image')->default('img.png');
            $table->string('additional_images')->nullable();
            $table->string('dimensions')->default('0|0|0');
            $table->string('categories')->nullable();
            $table->integer('status')->default(0);
            $table->string('added_by')->default('owner@sms.lk');
            //$table->foreign('added_by')->references('email')->on('employee')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
