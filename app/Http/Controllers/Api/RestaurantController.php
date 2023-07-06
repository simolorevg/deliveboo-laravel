<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $restaurants = Restaurant::with(['categories' , 'dishes']);

        if ($request->has('categories')) {
            $categories = explode(',', trim($request->input('categories')));
            $restaurants = $restaurants->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('categories.id', $categories);
            });
        }
        
        $restaurants  = $restaurants ->paginate(5);

        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }

    public function show($slug)
    {
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
