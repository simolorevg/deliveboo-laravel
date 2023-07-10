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
        $categories = Category::all();
        $restaurants = Restaurant::all();
    
        foreach ($restaurants as $restaurant) {
            $randomCategories = $categories->random(rand(1, 3)); // Genera un numero casuale di categorie per ogni ristorante
    
            foreach ($randomCategories as $category) {
                $restaurant->categories()->attach($category);
            }
        }
    }
    
}
