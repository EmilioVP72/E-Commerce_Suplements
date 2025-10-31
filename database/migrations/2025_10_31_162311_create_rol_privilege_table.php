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
        Schema::create('rol_privilege', function (Blueprint $table) {
            $table->foreignId('id_rol')->references('id_rol')->on('rol');
            $table->foreignId('id_privilege')->references('id_privilege')->on('privilege');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_privilege');
    }
};
