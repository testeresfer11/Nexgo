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
        Schema::table('ride_alerts', function (Blueprint $table) {
            $table->foreign(['user_id'], 'ride_alerts_ibfk_1')->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ride_alerts', function (Blueprint $table) {
            $table->dropForeign('ride_alerts_ibfk_1');
        });
    }
};
