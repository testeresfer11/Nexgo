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
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('car_id');
            $table->unsignedBigInteger('user_id')->index('cars_user_id_foreign');
            $table->string('make', 50)->nullable();
            $table->string('model', 50)->nullable();
            $table->integer('year')->nullable();
            $table->string('license_plate', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->integer('seats')->nullable();
            $table->timestamps();
            $table->string('type', 50)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
