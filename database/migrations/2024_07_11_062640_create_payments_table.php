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
        Schema::create('payments', function (Blueprint $table) {
            
            $table->id('payment_id');
            $table->unsignedBigInteger('booking_id');
            $table->decimal('amount',10,2)->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status', '20')->nullable();
            $table->decimal('refunded_amount', 10, 2)->nullable();
            $table->decimal('divided_amount', 10, 2)->default(0.00);
            $table->string('paypal_captureId')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('refund_id')->nullable();
            $table->tinyInteger('is_refunded')->default(0);
            $table->boolean('is_automatic_refunded')->default(0);
            $table->boolean('refund_status')->default(0);
            $table->string('payment_slip')->nullable();
            $table->timestamps();
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
