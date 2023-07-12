<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "token" => "required", //token che genera il frontend ma braintree ci simula il token con fake-valid-nonce
            // "amount" => "required", //'prezzo, passare id del prodotto'
            "products" => "required",
            "guest_name" => "required",
            "guest_lastname" => "required",
            "guest_address" => "required",
            "guest_phone" => "required",
            "guest_mail" => "required"
        ];
    }
}
