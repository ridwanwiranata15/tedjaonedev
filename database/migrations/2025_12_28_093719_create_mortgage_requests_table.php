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
        Schema::create('mortgage_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('interest_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('interst');
            $table->string('dp_total_amount');
            $table->string('dp_percentage');
            $table->string('loan_total_amount');
            $table->string('loan_interest_total_amount');
            $table->string('monthly_amount');
            $table->string('status');
            $table->string('documents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mortgage_requests');
    }
};
