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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('profile_picture')->nullable();
            $table->longText('bio')->nullable();
            $table->double('rating')->nullable();
            $table->integer('role_id')->nullable()->default(1)->comment('1-User, 2-Admin');
            $table->timestamp('join_date')->nullable();
            $table->integer('status')->nullable()->default(1)->comment('1-Active, 1-Inactive');
            $table->integer('phone_otp')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('id_card')->nullable();
            $table->string('verify_id')->nullable()->default('1')->comment('1-pending,2-verified,3-rejected');
            $table->string('chattiness', 50)->nullable();
            $table->string('music', 50)->nullable();
            $table->string('smoking')->nullable();
            $table->string('pets')->nullable();
            $table->timestamp('phone_verfied_at')->nullable();
            $table->timestamp('phone_otp_expires_at')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('stripe_connect_account_id')->nullable();
            $table->text('fcm_token')->nullable();
            $table->string('device_type')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->boolean('is_notification_ride')->nullable()->default(true);
            $table->boolean('is_notification_plan')->nullable()->default(false);
            $table->boolean('is_notification_message')->nullable()->default(false);
            $table->boolean('is_email_plan')->nullable()->default(false);
            $table->boolean('is_email_message')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
