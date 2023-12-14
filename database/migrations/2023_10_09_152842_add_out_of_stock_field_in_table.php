<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products_attr', function (Blueprint $table) {
            $table->tinyInteger('out_of_stock')->after('color_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products_attr', function (Blueprint $table) {
            $table->dropColumn('out_of_stock');
        });
    }
};
