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
        Schema::table('chat_tokens', function (Blueprint $table) {
            $table->foreign(['ride_id'], 'chat_tokens_ibfk_1')->references(['ride_id'])->on('rides')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['driver_id'], 'chat_tokens_ibfk_2')->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'chat_tokens_ibfk_3')->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_tokens', function (Blueprint $table) {
            $table->dropForeign('chat_tokens_ibfk_1');
            $table->dropForeign('chat_tokens_ibfk_2');
            $table->dropForeign('chat_tokens_ibfk_3');
        });
    }
};
