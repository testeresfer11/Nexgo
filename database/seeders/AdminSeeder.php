<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@yopmail.com',
            'password' => Hash::make('Admin@123'),
            'role_id' => 2, // Ensure 'role_id' exists in your 'users' table
            'status' => 1,  // Ensure 'status' exists in your 'users' table
            'email_verified_at' => now(),
        ]);
    }
}
