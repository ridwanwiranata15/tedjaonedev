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
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mortgage_request_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('no_of_payment');
            $table->string('total_tax_payment');
            $table->string('grand_total_amount');
            $table->string('sub_total_amount');
            $table->string('insurance_amount');
            $table->string('proof');
            $table->enum('is_paid', ['approve', 'rejected']);
            $table->string('payment_type');
            $table->string('remaining_loan_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
