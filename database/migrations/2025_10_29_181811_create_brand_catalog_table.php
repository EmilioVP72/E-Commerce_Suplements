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
        Schema::create('brand_catalog', function (Blueprint $table) {
            $table->foreignId('id_brand')->references('id_brand')->on('brand');
            $table->foreignId('id_catalog')->references('id_catalog')->on('catalog');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_catalog');
    }
};
