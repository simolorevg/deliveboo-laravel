<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'guest_name' => ['required','min:5', 'max:40'],
            'guest_lastname' =>  ['required','min:5', 'max:40'],
            'guest_address' =>  ['required','min:5', 'max:40'],
            'guest_phone' => 'required'|'string',
            'guest_mail' => 'required|email',
            'total_goods' => 'required|integer',
            'total' => 'required|numeric'
            
        ];
    }
    
    public function messages()
    {
        return [
            'guest_name.required' => 'Il nome dell\'ospite è obbligatorio.',
            'guest_name.min' => 'Il nome dell\'ospite deve avere un minimo di :min caratteri',
            'guest_name.max' => 'Il nome dell\'ospite deve avere un massimo di :max caratteri',
            'guest_lastname.required' => 'Il cognome dell\'ospite è obbligatorio.',
            'guest_lastname.min' => 'Il cognome dell\'ospite deve avere un minimo di :min caratteri',
            'guest_lastname.max' => 'Il cognome dell\'ospite deve avere un massimo di :max caratteri',
            'guest_address.required' => 'L\'indirizzo dell\'ospite è obbligatorio.',
            'guest_address.min' => 'L\'indirizzo dell\'ospite deve avere un minimo di :min caratteri',
            'guest_address.max' => 'L\' indirizzo dell\'ospite deve avere un massimo di :max caratteri',
            'guest_phone.required' => 'Il numero di telefono è richiesto',
            'guest_mail.required' => 'L\'email è richiesta',
            'total_goods.required' => 'Il carrello è vuoto'
        ];
    }
}
