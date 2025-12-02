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
        Schema::create('residence_user', function (Blueprint $table) {
            $table->bigIncrements('id_residence_user');
            $table->unsignedBigInteger('id_residence');
            $table->unsignedBigInteger('id_user');
            $table->primary(['id_residence', 'id_user']);

            $table->foreign('id_residence')->references('id_residence')->on('residence')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residence_user');
    }
};
