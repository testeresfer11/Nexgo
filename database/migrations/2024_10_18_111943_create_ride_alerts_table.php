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
        Schema::create('ride_alerts', function (Blueprint $table) {

            $table->id();
           $table->unsignedBigInteger('user_id');

            $table->date('departure_time');
            $table->string('departure_city', 255);
            $table->string('arrival_city', 255)->nullable();
            $table->double('user_departure_lat')->nullable();
            $table->double('user_departure_long')->nullable();
            $table->double('user_arrival_lat')->nullable();
            $table->double('user_arrival_long')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_alerts');
    }
};
