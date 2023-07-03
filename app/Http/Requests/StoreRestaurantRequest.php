<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRestaurantRequest extends FormRequest
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
            'restaurant_name' => ['required', 'min:5', 'max:40', Rule::unique('restaurants')->ignore($this->restaurant)],
            'city' => 'nullable|string',
            'address' => 'text|string',
            'phone' => 'nullable|string',
            'vat_number' => ['nullable|string'],
            'categories' => ['nullable', 'exist:categories,id'],
            'image' => 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'restaurant_name.required' => 'Il nome del ristorante è richiesto',
            'restaurant_name.min' => 'Il nome del ristorante deve avere un minimo di :min caratteri',
            'restaurant_name.max' => 'Il nome del ristorante non può avere più di :max caratteri',
            'restaurant_name.unique' => 'Nome ristorante già utilizzato.'
        ];
    }
}
