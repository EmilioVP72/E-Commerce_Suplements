<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shopping_cart', function (Blueprint $table) {
            $table->id('id_cart');
            $table->unsignedBigInteger('id_user');
            $table->unsignedInteger('id_product');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('cascade');
            $table->unique(['id_user', 'id_product']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shopping_cart');
    }
};