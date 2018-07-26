<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DadosNovoFormularioRequest extends FormRequest
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
            'tituloFormulario'    => 'required',
            'grupoDivulgacao'     => 'required',
            'action'              => 'required|max:7|min:5'
        ];
    }

    public function messages()
    {
        return [
            'tituloFormulario.required'         => "O campo Título de Formulário deve ter um valor selecionado. Por favor, verifique!",
            'grupoDivulgacao.required'          => "O campo Grupo de Divulgação deve ter um valor selecionado. Por favor, verifique!",
            'action.required'                   => "Por favor, não modifique o código da página depois de interpretada! =D"            
        ];
    }

}
