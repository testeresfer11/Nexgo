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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign(['passenger_id'])->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['ride_id'])->references(['ride_id'])->on('rides')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('bookings_passenger_id_foreign');
            $table->dropForeign('bookings_ride_id_foreign');
        });
    }
};
