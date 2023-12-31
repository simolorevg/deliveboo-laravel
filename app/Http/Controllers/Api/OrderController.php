<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
    }


    public function store(Request $request)
    {
        // Esegue la validazione dei dati dell'ordine
        $validatedData = $request->validate([
            'guest_name' => 'required',
            'guest_lastname' => 'required',
            'guest_address' => 'required',
            'guest_phone' => 'required',
            'guest_mail' => 'required|email',
        ]);

        // Crea un nuovo ordine
        $order = new Order();
        $order->guest_name = $validatedData['guest_name'];
        $order->guest_lastname = $validatedData['guest_lastname'];
        $order->guest_address = $validatedData['guest_address'];
        $order->guest_phone = $validatedData['guest_phone'];
        $order->guest_mail = $validatedData['guest_mail'];
        $order->save();

        // Collega i piatti all'ordine
        $order->dishes()->attach($validatedData['dishes']);

        return response()->json(
            ['message' => 'Ordine creato con successo'],
            201,
            ['Content-Type' => 'application/json']
        );
    }
}
