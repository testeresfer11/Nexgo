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
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('booking_id');
            $table->unsignedBigInteger('ride_id')->index('bookings_ride_id_foreign');
            $table->unsignedBigInteger('passenger_id')->index('bookings_passenger_id_foreign');
            $table->timestamp('booking_date')->nullable();
            $table->string('status', 20)->nullable();
            $table->integer('seat_count')->nullable();
            $table->string('departure_location')->nullable();
            $table->string('departure_distance')->nullable()->default('0');
            $table->string('arrival_location')->nullable();
            $table->string('arrival_distance')->nullable()->default('0');
            $table->string('total_time_estimation')->nullable();
            $table->string('departure_time')->nullable();
            $table->string('arrival_time')->nullable();
            $table->string('departure_lat')->nullable();
            $table->string('departure_long')->nullable();
            $table->string('arrival_lat')->nullable();
            $table->string('arrival_long')->nullable();
            $table->timestamps();
            $table->decimal('amount', 10, 0)->nullable();
            $table->decimal('platform_amount', 10, 0)->nullable();
            $table->boolean('cancel_before_24')->nullable()->default(false);
            $table->boolean('cancel_after_24')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
