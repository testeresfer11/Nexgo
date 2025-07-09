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
        Schema::table('rides', function (Blueprint $table) {
            $table->foreign(['car_id'])->references(['car_id'])->on('cars')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['driver_id'])->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rides', function (Blueprint $table) {
            $table->dropForeign('rides_car_id_foreign');
            $table->dropForeign('rides_driver_id_foreign');
        });
    }
};
