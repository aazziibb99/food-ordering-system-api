<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'customer_id' => 1,  // assuming Ahmad Bin Ali has ID 1
                'restaurant_id' => 1,  // assuming Nasi Lemak Corner has ID 1
                'order_date' => now(),
                'total_amount' => 23.50,
                'pickup_or_delivery' => 'Delivery',
                'status' => 'Completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 1,  // assuming Ahmad Bin Ali has ID 1
                'restaurant_id' => 2,  // assuming Pasta Italia has ID 2
                'order_date' => now(),
                'total_amount' => 18.00,
                'pickup_or_delivery' => 'Pickup',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
