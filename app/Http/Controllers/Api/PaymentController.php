<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\NewOrderMail;
use App\Models\Dish;
use App\Models\Order;
use Braintree\Collection;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function tokenGenerate(Gateway $gateway)
    {
        // genera un token client utilizzando $gateway->clientToken()->generate()
        $token = $gateway->clientToken()->generate();
        $data = [
            "token" => $token,
            "success" => true
        ];

        return response()->json($data, 200);
    }


    public function makePayment(OrderRequest $request, Gateway $gateway)
    {

        $total = 0;
        $idArray = collect($request->products)->pluck('dish_id')->toArray();
        $quantityArray = collect($request->products)->pluck('quantity')->toArray();
        $dishesArray = Dish::whereIn('id', $idArray)->get();

        foreach ($dishesArray as $key => $dish) {
            $total += $dish->price * $quantityArray[$key];
        }

        
        // dd($request->token);
        $result = $gateway->transaction()->sale([
            "amount" => $total,
            "paymentMethodNonce" => $request->token, //token che genererà il front con js
            "options" => [
                'submitForSettlement' => true
            ],
        ]);

        if ($result->success) {
            // Creazione di un nuovo ordine
            $order = Order::create([
                "guest_name" => $request->guest_name,
                "guest_lastname" => $request->guest_lastname,
                "guest_address" => $request->guest_address,
                "guest_phone" => $request->guest_phone,
                "guest_mail" => $request->guest_mail,
            ]);

            // Aggiunta dei piatti all'ordine
            $dishes = $request->products;
            
            foreach ($dishes as $dish) {
                $dishId = $dish['dish_id'];
                $quantity = $dish['quantity'];
                
                $order->dishes()->attach($dishId, ['quantity' => $quantity]);
            }
            
            $data = [
                "message" => "transizione effettuata",
                "success" => true,
                "data_confirm" => "I dati sono stati salvati nel database."
            ];

            Mail::to($request->guest_mail)->send(new NewOrderMail($order));
        } else {
            
            $data = [
                "message"  => "transizione rifiutata",
                "success" => false,
                "data_confirm" =>  "I dati NON sono stati salvati nel database."
            ];
        }
        
        return response()->json($data);
    }
}
