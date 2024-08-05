<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_items')->insert([
            [
                'order_id' => 1,  // assuming the order with ID 1 exists
                'menu_id' => 1,  // assuming Nasi Lemak has ID 1
                'quantity' => 1,
                'price' => 8.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,  // assuming the order with ID 1 exists
                'menu_id' => 2,  // assuming Rendang Daging has ID 2
                'quantity' => 1,
                'price' => 15.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,  // assuming the order with ID 2 exists
                'menu_id' => 3,  // assuming Spaghetti Carbonara has ID 3
                'quantity' => 1,
                'price' => 18.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
