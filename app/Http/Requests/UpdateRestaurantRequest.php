<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRestaurantRequest extends FormRequest
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
            'restaurant_name' => ['required', 'min:5', 'max:40'],
            'city' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'vat_number' => ['required', Rule::unique('restaurants', 'vat_number')],
            'category_id' => ['required', 'exists:categories,id'],
            'thumb' => 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'restaurant_name.required' => 'Il nome del ristorante è richiesto',
            'restaurant_name.min' => 'Il nome del ristorante deve avere un minimo di :min caratteri',
            'restaurant_name.max' => 'Il nome del ristorante non può avere più di :max caratteri',
            'restaurant_name.unique' => 'Nome ristorante già utilizzato.',
            'vat_number.unique' => 'Partita I.V.A. già registrata.',
            'city.required' => 'La città è richiesta',
            'address.required' => 'Indirizzo obbligatorio',
            'phone.required' => 'Il numero di telefono è richiesto'
        ];
    }
}
