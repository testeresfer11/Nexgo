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
        Schema::table('payouts', function (Blueprint $table) {
            $table->foreign(['ride_id'], 'payouts_ibfk_1')->references(['ride_id'])->on('rides')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['driver_id'], 'payouts_ibfk_2')->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payouts', function (Blueprint $table) {
            $table->dropForeign('payouts_ibfk_1');
            $table->dropForeign('payouts_ibfk_2');
        });
    }
};
