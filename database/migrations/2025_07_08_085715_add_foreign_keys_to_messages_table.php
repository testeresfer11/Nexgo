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
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign(['booking_id'], 'messages_ibfk_1')->references(['booking_id'])->on('bookings')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['ride_id'], 'messages_ibfk_2')->references(['ride_id'])->on('rides')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['receiver_id'])->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['sender_id'])->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_ibfk_1');
            $table->dropForeign('messages_ibfk_2');
            $table->dropForeign('messages_receiver_id_foreign');
            $table->dropForeign('messages_sender_id_foreign');
        });
    }
};
