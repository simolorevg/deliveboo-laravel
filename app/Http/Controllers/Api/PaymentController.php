<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function tokenGenerate(Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();
        $data = [
            "token" => $token,
            "success" => true
        ];

        return response()->json($data, 200);
    }


    public function makePayment(Request $request, Gateway $gateway)
    {

        $result = $gateway->transaction()->sale([
            "amount" => $request->amount,
            "paymentMethodNonce" => $request->token,
            "options" => [
                'submitForSettlement' => true
            ],
        ]);

        if ($result->success) {
            $data = [
                'message' => 'transizione effettevata',
                'success' => true,
                'data_confirm' => 'data has benn saved'
            ];
        } else {
            $data = [
                'message' => 'transizione rifiutata',
                'success' => false,
                'data_confirm' => 'data has benn saved'
            ];
        }
        return response()->json($data);
    }
}
