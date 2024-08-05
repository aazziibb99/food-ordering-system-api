<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurant_menus')->insert([
            [
                'restaurant_id' => 1,  // assuming Nasi Lemak Corner has ID 1
                'name' => 'Nasi Lemak',
                'description' => 'Coconut rice served with sambal, fried crispy anchovies, peanuts, and boiled egg',
                'price' => 8.50,
                'category' => 'Main Course',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 1,  // assuming Nasi Lemak Corner has ID 1
                'name' => 'Rendang Daging',
                'description' => 'Slow-cooked beef in a spicy coconut sauce',
                'price' => 15.00,
                'category' => 'Main Course',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'restaurant_id' => 2,  // assuming Pasta Italia has ID 2
                'name' => 'Spaghetti Carbonara',
                'description' => 'Spaghetti with creamy carbonara sauce and pancetta',
                'price' => 18.00,
                'category' => 'Main Course',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
