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
        Schema::create('fares', function (Blueprint $table) {
            $table->id();
            $table->string('city')->nullable();
            $table->decimal('base_fare', 8, 2);
            $table->decimal('cost_per_kilometer', 8, 2); 
            $table->decimal('cost_per_minute', 8, 2)->nullable(); 
            $table->string('service_type')->nullable();
            $table->unsignedBigInteger('car_id')->nullable(); 
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fares');
    }
};

