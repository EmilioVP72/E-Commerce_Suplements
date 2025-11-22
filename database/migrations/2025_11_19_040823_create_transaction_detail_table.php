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
        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('id_transaction');
            $table->unsignedBigInteger('id_payment_method');
            $table->primary(['id_transaction', 'id_payment_method']);

            $table->foreign('id_transaction')->references('id_transaction')->on('transaction')->onDelete('cascade');
            $table->foreign('id_payment_method')->references('id_payment_method')->on('payment_method')->onDelete('cascade');
            $table->text('folio');
            $table->decimal('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_detail');
    }
};
