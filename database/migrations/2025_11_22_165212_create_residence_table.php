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
        Schema::create('residence', function (Blueprint $table) {
            $table->increments('id_residence');
            $table->string('zip_code', 100);
            $table->string('state', 150);
            $table->string('city', 250);
            $table->string('address', 500);
            $table->string('extra_directions', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residence');
    }
};
