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
        Schema::create('payouts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('ride_id')->nullable()->index('ride_id');
            $table->unsignedBigInteger('driver_id')->nullable()->index('driver_id');
            $table->decimal('amount', 10)->nullable();
            $table->decimal('total', 10)->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->decimal('amount_paid_by_admin', 10)->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('payment_slip')->nullable();
            $table->string('payment_method')->nullable();
            $table->date('payment_date')->nullable();
            $table->integer('platform_fee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
