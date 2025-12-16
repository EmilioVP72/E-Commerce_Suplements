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
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id_transaction');
            $table->text('data');
            $table->json('qr_code');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
