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
        Schema::create('purchase_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('id_purchase');
            $table->unsignedBigInteger('id_product');
            $table->primary(['id_purchase', 'id_product']);
            $table->integer('amount');

            $table->foreign('id_purchase')->references('id_purchase')->on('purchase')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('product')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_detail');
    }
};
