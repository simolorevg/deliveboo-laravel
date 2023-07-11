<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        // Ottieni l'array di categorie inviato come input dalla richiesta
        $data = $request->input('categories');

        // Recupera i ristoranti con le relazioni "categories" e "dishes" 
        $restaurants = Restaurant::with(['categories', 'dishes']);

        // Se l'array di categorie non è fornito, ottieni tutti i ristoranti senza filtri
        if (empty($data)) {
            $restaurants = $restaurants->paginate(10);

            return response()->json([
                'success' => true,
                'results' => $restaurants
            ]);
        }

        // Filtra i ristoranti che hanno almeno una categoria con ID presente nell'array di categorie
        $restaurants->whereHas('categories', function ($query) use ($data) {
            $query->whereIn('categories.id', $data);
        });
        // es array con 3 elementi , es id 1 3 e 5 

        $restaurants = $restaurants->paginate(10);

        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }



    public function show($slug)
    {
        // dd('ciao');
        $restaurant = Restaurant::with('categories', 'dishes', 'user')->where('slug', $slug)->first();
        if ($restaurant) {
            return response()->json([
                'success' => true,
                'results' => $restaurant
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Ristorante non trovato'
            ])->setStatusCode(404);
        };
    }
}
