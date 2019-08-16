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
            'tituloFormulario'    => 'required|string|max:350',
            'action'              => 'required|max:7|min:5',
            
            // Controle de Registros
            'setor_dono_form'            => 'required|integer',
            'nivelAcessoDocumento'       => 'required|string|max:20',
            'meio_distribuicao_id'       => 'required|integer',
            'local_armazenamento_id'     => 'required|integer',
            'protecao_id'                => 'required|integer',
            'recuperacao_id'             => 'required|integer',
            'tempo_retencao_local_id'    => 'required|integer',
            'tempo_retencao_deposito_id' => 'required|integer',
            'disposicao_id'              => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'tituloFormulario.required'         => "O campo Título de Formulário deve ter um valor selecionado. Por favor, verifique!",
            'action.required'                   => "Por favor, não modifique o código da página depois de interpretada! =D"            
        ];
    }

}
