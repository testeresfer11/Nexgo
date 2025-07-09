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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('message_id');
            $table->unsignedBigInteger('booking_id')->index('booking_id');
            $table->unsignedBigInteger('sender_id')->index('messages_sender_id_foreign');
            $table->unsignedBigInteger('receiver_id')->index('messages_receiver_id_foreign');
            $table->text('content');
            $table->timestamp('timestamp')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('ride_id')->nullable()->index('ride_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
