<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use Faker\Generator as Faker;
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
        for ($i = 0; $i < 10; $i ++){

            // $dish = new Dish();
            // $dish->dish_name = $faker->sentence(2);
            // $dish->slug = Str::slug($dish->dish_name, '-');
            // $dish->description = $faker->sentences(10);
            // $dish->ingredients = $faker->sentences(10);
            // $dish->price = $faker->randomFloat(2 , 1 , 111);
            // $dish->is_available = $faker->boolean();
            // $dish->img = $faker->imageUrl(400, 700, 'foods', true);
            // $dish->save();

        }
    }
}
