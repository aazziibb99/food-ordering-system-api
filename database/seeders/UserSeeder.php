<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Ahmad Bin Ali',
                'email' => 'ahmad.ali@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('password123'),
                'phone_number' => '0123456789',
                'address' => 'No. 10, Jalan Bukit, 50480 Kuala Lumpur, Malaysia',
                'role' => 'Customer',
                'loyalty_points' => 100,
                'remember_token' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Aishah',
                'email' => 'siti.aishah@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('password123'),
                'phone_number' => '0198765432',
                'address' => null,  // Not applicable for Manager role
                'role' => 'Manager',
                'loyalty_points' => 0,
                'remember_token' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('adminpassword'),
                'phone_number' => null,  // Not applicable for Administrator role
                'address' => null,  // Not applicable for Administrator role
                'role' => 'Administrator',
                'loyalty_points' => 0,
                'remember_token' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
