<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::paginate(5);   
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
