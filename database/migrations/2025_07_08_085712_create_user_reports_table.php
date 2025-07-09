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
        Schema::create('user_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('driver_id')->index('user_reports_driver_id_foreign');
            $table->unsignedBigInteger('passenger_id')->index('user_reports_passenger_id_foreign');
            $table->unsignedBigInteger('ride_id')->index('user_reports_ride_id_foreign');
            $table->unsignedBigInteger('report_id')->index('user_reports_report_id_foreign');
            $table->string('description');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reports');
    }
};
