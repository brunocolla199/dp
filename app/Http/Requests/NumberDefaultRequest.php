<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NumberDefaultRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'numeroPadrao' => 'required|max:4|min:1|regex:/^[0-9]{1}[\.]?/' // max: 001.01 | min: 1
        ];
    }

    public function messages()
    {
        return [
            'numeroPadrao.required'  => "O campo deve ter um valor definido. Por favor, verifique!",     
            'numeroPadrao.max'       => "O campo deve possuir, no máximo, 4 dígitos. Por favor, verifique!",     
            'numeroPadrao.min'       => "O campo deve possuir, no mínimo, 1 dígito. Por favor, verifique!",     
            'numeroPadrao.regex'     => "O campo deve possuir entre 1 e 3 dígitos numéricos. Opcionalmente, pode ser incrementado um ponto (.)!",    
        ];
    }
}
