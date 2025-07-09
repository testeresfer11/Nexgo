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
        Schema::create('rides', function (Blueprint $table) {
            $table->bigIncrements('ride_id');
            $table->unsignedBigInteger('driver_id')->index('rides_driver_id_foreign');
            $table->unsignedBigInteger('car_id')->nullable()->index('rides_car_id_foreign');
            $table->text('departure_city')->nullable();
            $table->string('departure_lat', 100)->nullable();
            $table->string('departure_long', 100)->nullable();
            $table->text('arrival_city')->nullable();
            $table->string('arrival_lat', 100)->nullable();
            $table->string('arrival_long', 100)->nullable();
            $table->timestamp('departure_time')->nullable();
            $table->timestamp('arrival_time')->nullable();
            $table->decimal('price_per_seat')->nullable();
            $table->decimal('destination_to_stopover1_price')->nullable();
            $table->decimal('destination_to_stopover2_price')->nullable();
            $table->decimal('stopover1_to_stopover2_price')->nullable();
            $table->decimal('stopover2_to_arrival_price')->nullable();
            $table->decimal('stopover1_to_arrival_price')->nullable();
            $table->integer('available_seats')->nullable();
            $table->string('luggage_size', 50)->nullable();
            $table->string('smoking_allowed')->nullable();
            $table->string('pets_allowed')->nullable();
            $table->string('music_preference', 50)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->integer('seat_booked')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0)->comment('1-active, 2-completed, 3-cancelled');
            $table->boolean('max_two_back')->default(false);
            $table->boolean('women_only')->default(false);
            $table->string('stopovers')->nullable()->default('[]');
            $table->string('stopover1')->nullable();
            $table->string('stopover1_lat')->nullable();
            $table->string('stopover1_long')->nullable();
            $table->string('stopover2')->nullable();
            $table->string('stopover2_lat')->nullable();
            $table->string('stopover2_long')->nullable();
            $table->string('type', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
