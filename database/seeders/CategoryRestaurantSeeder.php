<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryRestaurantSeeder extends Seeder
{
    public function run()
    {
        $restaurants = Restaurant::all();
        $categories = Category::all();

        foreach ($restaurants as $restaurant) {
            $categoryCount = rand(1, 2);
            $selectedCategories = $categories->random($categoryCount);

            $restaurant->categories()->attach($selectedCategories);
        }
    }
}
