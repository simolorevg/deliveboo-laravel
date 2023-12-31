<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(CategoriesSeeder::class);
       $this->call(UserSeeder::class);
       $this->call(RestaurantSeeder::class);
       $this->call(DishSeeder::class);
       $this->call(CategoryRestaurantSeeder::class);
       $this->call(DishSeeder::class);
        
    }
}
