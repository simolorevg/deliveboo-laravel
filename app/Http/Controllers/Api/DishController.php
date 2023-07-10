<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Restaurant;

class DishController extends Controller
{
    public function index(Request $request)
    {
        $restaurantId = $request->query('restaurant_id');

        if ($restaurantId) {
            $restaurant = Restaurant::find($restaurantId);
            if (!$restaurant) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ristorante non trovato.'
                ], 404);
            }
            
            $dishes = $restaurant->dishes()->paginate(5); // Modifica qui per paginare per 5 elementi
            if ($dishes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Piatti non trovati per questo ristorante.'
                ], 404);
            }
        } else {
            $dishes = Dish::paginate(5); // Modifica qui per paginare per 5 elementi
        }

        return response()->json([
            'success' => true,
            'results' => $dishes
        ]);
    }




    public function show($slug)
    {
        $dish = Dish::where('slug', $slug)->first();
        if ($dish) {
            return response()->json([
                'success' => true,
                'results' => $dish
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Piatto non trovato'
            ])->setStatusCode(404);
        };
    }
}
