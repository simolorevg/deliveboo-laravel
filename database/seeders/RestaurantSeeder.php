<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Restaurant;
use App\Models\Category;
use Nette\Utils\Random;

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
        // $thumbs = [
        //     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmgY-pdaQF0g-enI6o1zIAQeHgnh15_Ia5l1p1XqVv1M0_lr2ooWtcUOHmo7Cgxge4boc&usqp=CAU',
        //     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQW3VxshCiRPmRUNQQXGfSWtzyQ49d5nJOnPjpg1l7AxZ6NcssW9hO-JuNTmiW8gEv160Y&usqp=CAU',
        //     'https://www.pinterest.it/testadelia98/logo-per-ristorante/',
        //     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlEYJolVYyiLG0ZqLTRFCgJ2yV4izrL1qfHAJWFeDOjR1Ly39ikysJwQiyyNx9m-hmPec&usqp=CAU',
        //     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdqm6-YaLkgIFXfeXwEcwJikYQAIilxcvd7Csf1nhK5_GLF9L1o6r7GC9ph-aGSlHT_tI&usqp=CAU',
        //     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLoAkjrbdSaoqMlBuFIdRqh5-IechIp7PffYWmj10nwv_mmXbhsFUnMa1Ih356dCdphiY&usqp=CAU0',
        //     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzPL08WYNdCX8zE80YSMEp3DPgw1ANFjdoWn9oVO8Q4g_Nls1q7vkZ6BPzskpG5ObM9OU&usqp=CAU',
        //     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLSI04CzscU1NaqezJWXaHubcMwwBlEYW7wruYG6d_uKUWASWEh1GF2cJzYlGYBtZQvLM&usqp=CAU',
        //     'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2nGn31nUM82FfBeuebUTxFnN5VQV2xyRoZZa23AyTWpFeJ0-WvGTyncs73iUDCldMKZI&usqp=CAU'
        // ];
        for ($i = 1; $i <= $restaurantsCount; $i++) {
            $userId = $i;
            DB::table('restaurants')->insert([
                'user_id' => $userId,
                'restaurant_name' => 'Ristorante ' . $i,
                'slug' => 'ristorante-' . $i,
                'city' => 'Città ' . $i,
                'address' => 'Indirizzo ' . $i,
                'phone' => '12' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'vat_number' => str_pad(rand(0, 99999999999), 11, '0', STR_PAD_LEFT),
                // 'thumb' => $thumbs[array_rand($thumbs)],
                'closure_day' => 'Chiusura ' . $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
