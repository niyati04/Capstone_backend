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
            $table->id();
            $table->integer('category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->enum('casual_wear', ['oversize', 'regular'])->default('oversize');
            $table->enum('design_by', ['embroidery', 'graphic', 'regular'])->default('regular');
            $table->string('original_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('is_tranding')->default(0);
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
        Schema::dropIfExists('products');
    }
};
