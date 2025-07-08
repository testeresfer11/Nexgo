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
            $table->id(); 

            $table->unsignedBigInteger('ride_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();

            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->decimal('amount_paid_by_admin', 10, 2)->nullable();

            $table->timestamp('created_at')->nullable()->useCurrentOnUpdate(); // for ON UPDATE CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->nullable();

            $table->string('payment_slip', 255)->nullable();
            $table->string('payment_method', 255)->nullable();
            $table->date('payment_date')->nullable();
            $table->integer('platform_fee', false, true)->nullable();

          
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
