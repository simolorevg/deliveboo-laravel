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
            'restaurant_name' =>['required', 'min:5', 'max:40',Rule::unique('restaurants')->ignore($this->restaurant)],
            'city' => 'nullable|string',
            'address' => 'text|string',
            'phone' => 'nullable|string',
            'vat_number' => ['nullable|string'] 

        ];
    }
}
