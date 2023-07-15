<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurantsCount = 20;
        $dishCount = 20;

        for ($i = 1; $i <= $restaurantsCount; $i++) {

            for ($k = 1; $k <= $dishCount; $k++) {
                $dish_name = $faker->word();
                $slug = Str::slug($dish_name . '-'  . $i . '-' . $k );
                DB::table('dishes')->insert([
                    'restaurant_id' => $i,
                    'dish_name' => $dish_name,
                    'slug' => $slug,
                    'description' => $faker->sentence(7, true),
                    'ingredients' => $faker->sentence(5, true),
                    'price' => $faker->randomFloat(2, 1, 111),
                    'is_available' => $faker->boolean(),
                    'img' => $faker->imageUrl(400, 700, 'foods', true),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            }
        }
    }
}
