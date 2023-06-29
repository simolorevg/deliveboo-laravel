<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       for ($i = 0 ; $i < 5 ; $i++){
        $restaurant = new Restaurant();
        $restaurant->restaurant_name = $faker->randomElement(['michele','napoli','zarrillo', 'sushilvio','simone']);
        $restaurant->slug = Str::slug($restaurant->restaurant_name, '-');
        $restaurant->address = $faker->address();
        $restaurant->phone = $faker->phoneNumber();
        $restaurant->vat_number = $faker->randomNumber(9, true);
        $restaurant->thumb = $faker->imageUrl(640, 480, 'restaurant', true);
        $restaurant->closure_day = $faker->dayOfWeek();
        $restaurant->save();
       }
    }
}
