<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        // Recupera tutti i ristoranti dal database
        $restaurants = Restaurant::all();
        
        foreach ($restaurants as $restaurant) {

            Order::create([
                'restaurant_id' => $restaurant->id,
                'slug' => $restaurant->id . 'order',
                'guest_name' => $faker->firstName,
                'guest_lastname' => $faker->lastName,
                'guest_address' => $faker->address,
                'guest_phone' => $faker->phoneNumber,
                'guest_mail' => $faker->email,
                'total_goods' => $faker->numberBetween(1, 10),
                'total' => $faker->randomFloat(2, 10, 100),
            ]);
        }
        
    }
}

// 'is_paid' => $faker->boolean(),