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
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('ride_id')->nullable(); // Nullable ride ID
            $table->unsignedBigInteger('driver_id'); // Driver ID
            $table->unsignedBigInteger('user_id'); // User ID
            $table->string('chat_token'); // Chat token
            $table->boolean('is_blocked')->default(false); // Indicates if the chat is blocked
            $table->unsignedBigInteger('blocked_by')->nullable(); // ID of the user who blocked the chat
            $table->timestamps(); // created_at and updated_at columns
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
