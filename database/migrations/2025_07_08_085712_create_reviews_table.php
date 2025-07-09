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
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('review_id');
            $table->unsignedBigInteger('ride_id')->index('reviews_ride_id_foreign');
            $table->unsignedBigInteger('reviewer_id')->index('reviews_reviewer_id_foreign');
            $table->unsignedBigInteger('receiver_id');
            $table->double('rating')->nullable();
            $table->text('comment')->nullable();
            $table->timestamp('review_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
