<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishRequest extends FormRequest
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
            'dish_name' => ['required','min:3','max:150', Rule::unique('dishes')->ignore($this->dish)],
            'ingredients' => 'required',
            'price' => 'required' , 
        ];
    }

    public function messages()
    {
        return [
            'dish_name.required' => 'Il nome del piatto è richiesto',
            'dish_name.min' => 'Il nome del piatto deve avere un minimo di :min caratteri',
            'dish_name.max' => 'Il nome del piatto non può avere più di :max caratteri',
            'dish_name.unique' => 'Nome piatto già utilizzato.',
            'ingredients.unique' => 'Lista ingredienti necessaria',
            'price.required' => 'Il prezzo è richiesta',
        ];
    }
}
