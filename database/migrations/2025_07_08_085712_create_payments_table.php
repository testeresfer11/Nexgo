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
            $table->bigIncrements('payment_id');
            $table->unsignedBigInteger('booking_id')->index('payments_booking_id_foreign');
            $table->decimal('amount', 10)->nullable();
            $table->decimal('refunded_amount', 10)->nullable();
            $table->decimal('divided_amount', 10)->default(0);
            $table->timestamp('payment_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status', 20)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('paypal_captureId')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('refund_id')->nullable();
            $table->tinyInteger('is_refunded')->nullable()->default(0);
            $table->boolean('is_automatic_refunded')->nullable()->default(false);
            $table->boolean('refund_status')->nullable()->default(false);
            $table->string('payment_slip')->nullable();
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
