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
        Schema::create('chat_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ride_id')->nullable()->index('ride_id');
            $table->unsignedBigInteger('driver_id')->index('driver_id');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->string('chat_token');
            $table->boolean('is_blocked')->default(false);
            $table->bigInteger('blocked_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_tokens');
    }
};
