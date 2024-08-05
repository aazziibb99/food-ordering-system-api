<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurants')->insert([
            [
                'name' => 'Nasi Lemak Corner',
                'category' => 'Malay',
                'address' => '25, Jalan Ampang, 55000 Kuala Lumpur, Malaysia',
                'phone_number' => '0134567890',
                'status' => 'Approved',
                'manager_id' => 2,  // assuming Siti Aishah has ID 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pasta Italia',
                'category' => 'Western',
                'address' => '15, Jalan Pudu, 55100 Kuala Lumpur, Malaysia',
                'phone_number' => '0171234567',
                'status' => 'Pending',
                'manager_id' => 2,  // assuming Siti Aishah has ID 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
