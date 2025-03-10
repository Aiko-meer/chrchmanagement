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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Payer's First Name
            $table->string('middle_name')->nullable(); // Payer's Middle Name
            $table->string('last_name'); // Payer's Last Name
            $table->string('reason'); // Reason for Payment
            $table->decimal('amount', 10, 2); // Payment Amount
            $table->date('payment_date'); // Payment Date
            $table->time('payment_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
