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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id_product');
            $table->string('product');
            $table->string('photo');
            $table->decimal('sale_price');
            $table->decimal('purchase_price');
            $table->text('description');
            $table->text('how_to_use');
            $table->text('warning');
            
            $table->foreignId('id_brand')->references('id_brand')->on('brand');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
