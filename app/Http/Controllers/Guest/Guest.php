<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Guest extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::all();
        $count = Auth::user()->restaurant->count();
        dd($count);
        return view('layouts.admin', compact('restaurant', 'count'));
    }
}
