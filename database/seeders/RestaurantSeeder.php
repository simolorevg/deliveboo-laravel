<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantsCount = 20;
        $usersCount = 20;

        for ($i = 1; $i <= $restaurantsCount; $i++) {
            // $userId = ($i <= $usersCount) ? $i : rand(1, $usersCount);
            $userId = $i;

            DB::table('restaurants')->insert([
                'user_id' => $userId,
                'restaurant_name' => 'Ristorante ' . $i,
                'slug' => 'ristorante-' . $i,
                'city' => 'Città ' . $i,
                'address' => 'Indirizzo ' . $i,
                'phone' => '12' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'vat_number' => str_pad(rand(0, 99999999999), 11, '0', STR_PAD_LEFT),
                'thumb' => 'path/to/thumbnail-' . $i . '.jpg',
                'closure_day' => 'Chiusura ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
