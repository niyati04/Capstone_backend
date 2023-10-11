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
        Schema::create('products_attr', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('image')->nullable();
            $table->string('qty')->nullable();
            $table->string('original_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('products_attr');
    }
};
