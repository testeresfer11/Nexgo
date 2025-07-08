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
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->text('departure_city')->nullable();
            $table->string('departure_lat', 100)->nullable();
            $table->string('departure_long', 100)->nullable();
            $table->text('arrival_city')->nullable();
            $table->string('arrival_lat', 100)->nullable();
            $table->string('arrival_long', 100)->nullable();
            $table->timestamp('departure_time')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_histories');
    }
};
