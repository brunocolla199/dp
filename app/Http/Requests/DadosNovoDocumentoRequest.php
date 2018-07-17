<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DadosNovoDocumentoRequest extends FormRequest
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
            'tipo_documento'      => 'required',
            'aprovador'           => 'required',
            'grupoTreinamento'    => 'required',
            'grupoDivulgacao'     => 'required',
            // 'areaInteresse'       => 'array|between:1,50',
            'tituloDocumento'     => 'required',
            'validadeDocumento'   => 'required|date_format:d/n/Y', // n = Numeric representation of a month, without leading zeros -> 1 through 12
            'copiaControlada'     => 'required',
            'action'              => 'required|max:7|min:5'
        ];
    }

    public function messages()
    {
        return [
            'tipo_documento.required'           => "O campo Tipo de Documento deve ter um valor selecionado. Por favor, verifique!",
            'aprovador.required'                => "O campo Aprovador deve ter um valor selecionado. Por favor, verifique!",
            'grupoTreinamento.required'         => "O campo Grupo de Treinamento deve ter um valor selecionado. Por favor, verifique!",
            'grupoDivulgacao.required'          => "O campo Grupo de Divulgação deve ter um valor selecionado. Por favor, verifique!",
            // 'areaInteresse.required'            => "O campo Área de Interesse deve ter ao menos um usuário selecionado. Por favor, verifique!",
            // 'areaInteresse.array'               => "Ocorreu um problema ao reconhecer os valors do campo campo Área de Interesse. Por favor, você pode entrar em contato com o suporte?",
            // 'areaInteresse.between'             => 'Ops, Área de Interesse precisa ter entre 1 e 50 itens. Por favor, você pode verificar isso?',
            'tituloDocumento.required'          => "O campo Título do Documento deve ser preenchido. Por favor, verifique!",
            'validadeDocumento.required'        => "O campo Validade do Documento deve ser preenchido. Por favor, verifique!",
            'validadeDocumento.date_format'     => "O campo Validade do Documento não corresponde ao formato d/m/Y. Por favor, verifique!",
            'action.required'                   => "Por favor, não modifique o código da página depois de interpretada! =D"            
        ];
    }

}
