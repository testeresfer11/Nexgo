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
            $table->id('ride_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('car_id')->nullable();
            
            $table->text('departure_city')->nullable();
            $table->string('departure_lat', 100)->nullable();
            $table->string('departure_long', 100)->nullable();
            
            $table->text('arrival_city')->nullable();
            $table->string('arrival_lat', 100)->nullable();
            $table->string('arrival_long', 100)->nullable();

            $table->timestamp('departure_time')->nullable();
            $table->timestamp('arrival_time')->nullable();

            $table->decimal('price_per_seat', 8, 2)->nullable();
            $table->decimal('destination_to_stopover1_price', 8, 2)->nullable();
            $table->decimal('destination_to_stopover2_price', 8, 2)->nullable();
            $table->decimal('stopover1_to_stopover2_price', 8, 2)->nullable();
            $table->decimal('stopover2_to_arrival_price', 8, 2)->nullable();
            $table->decimal('stopover1_to_arrival_price', 8, 2)->nullable();

            $table->integer('available_seats')->nullable();
            $table->string('luggage_size', 50)->nullable();

            $table->boolean('smoking_allowed')->default(false);
            $table->boolean('pets_allowed')->default(false);

            $table->string('music_preference', 50)->nullable();
            $table->text('description')->nullable();

            $table->integer('seat_booked')->default(0);
            $table->tinyInteger('status')->default(0)->comment('1-active, 2-completed, 3-cancelled');
            $table->boolean('max_two_back')->default(false);
            $table->boolean('women_only')->default(false);

            $table->string('stopovers', 255)->default('[]');
            $table->string('stopover1', 255)->nullable();
            $table->string('stopover1_lat', 255)->nullable();
            $table->string('stopover1_long', 255)->nullable();
            $table->string('stopover2', 255)->nullable();
            $table->string('stopover2_lat', 255)->nullable();
            $table->string('stopover2_long', 255)->nullable();

            $table->string('type', 50)->nullable();

            $table->timestamps();

            $table->foreign('driver_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('car_id')->on('cars')->onDelete('cascade');
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
