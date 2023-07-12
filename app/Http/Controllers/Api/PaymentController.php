<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Dish;
use App\Models\Order;
use Braintree\Collection;
use Braintree\Gateway;
use Illuminate\Http\Request;

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

        // dd($request);
        $total = 0;

        $idArray = collect($request->products)->pluck('dish_id')->toArray();
        $quantityArray = collect($request->products)->pluck('quantity')->toArray();
        $dishesArray = Dish::whereIn('id', $idArray)->get();

        foreach($dishesArray as $key => $carlo ){
            $total += $carlo->price * $quantityArray[$key] ;
        }

        
        $result = $gateway->transaction()->sale([
            "amount" => $total,
            "paymentMethodNonce" => $request->token, //token che genererà il front con js
            "options" => [
                'submitForSettlement' => true
            ],
        ]);

        //ESEMPIO
        // if ($result->success) { 
        //     $data = [
        //         'success' => true,
        //         'message' => 'Transazione completata',
        //         'order_details' => 'I dettagli dell\'ordine che hai salvato nel database',
        //         'transaction_id' => $result->transaction->id,
        //     ];
        //     return response()->json($data, 200);

        // } else {
        //     $data = [
        //         'success' => false,
        //         'message' => 'Transazione rifiutata',
        //     ];
        //     return response()->json($data, 40);
        // }


        if ($result->success) {
            // Creazione di un nuovo ordine
            $order = Order::create([
                'guest_name' => $request->guest_name,
                'guest_lastname' => $request->guest_lastname,
                'guest_address' => $request->guest_address,
                'guest_phone' => $request->guest_phone,
                'guest_mail' => $request->guest_mail,
            ]);

            // Aggiunta dei piatti all'ordine
            $dishes = $request->products;
            foreach ($dishes as $dish) {
                $dishId = $dish['dish_id'];
                $quantity = $dish['quantity'];

                $order->dishes()->attach($dishId, [
                    'quantity' => $quantity,
                ]);
            }

            $data = [
                'message' => 'transizione effettuata',
                'success' => true,
                'data_confirm' => 'I dati sono stati salvati nel database.'
            ];
        } else {

            $data = [
                'message' => 'transizione rifiutata',
                'success' => false,
                'data_confirm' => 'I dati non sono stati salvati nel database.'
            ];
        }

        return response()->json($data);
    }
}
