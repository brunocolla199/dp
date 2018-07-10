<?php

namespace App\Http\Controllers\Documentacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoDocumento;
use App\Setor;
use App\Classes\Constants;
use App\User;
use App\Http\Requests\DadosNovoDocumentoRequest;

class DocumentacaoController extends Controller
{
    
    public function index() {
        // $tipoDocumentos = TipoDocumento::orderBy('nome')->get()->pluck('nome', 'id');
        // $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'id');
        // $gruposTreinamento = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_TREINAMENTO)->orderBy('nome')->get()->pluck('nome', 'id');
        // $aprovadores       = User::orderBy('name')->get()->pluck('name', 'id');
        // $gruposDivulgacao  = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_DIVULGACAO)->orderBy('nome')->get()->pluck('nome', 'id');
        // $usuariosInteresse = User::orderBy('name')->get()->pluck('name', 'id');
        
        $tipoDocumentos = TipoDocumento::orderBy('nome')->get()->pluck('nome', 'nome');
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'nome');
        $gruposTreinamento = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_TREINAMENTO)->orderBy('nome')->get()->pluck('nome', 'nome');
        $gruposDivulgacao  = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_DIVULGACAO)->orderBy('nome')->get()->pluck('nome', 'nome');
        $aprovadores       = User::orderBy('name')->get()->pluck('name', 'name');
        $usuariosInteresse = User::orderBy('name')->get()->pluck('name', 'name');

        return view('documentacao.index', ['tipoDocumentos' => $tipoDocumentos, 'setores' => $setores, 'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao, 'aprovadores' => $aprovadores, 'usuariosInteresse' => $usuariosInteresse]);
    }


    public function validateData(DadosNovoDocumentoRequest $request) {
        $tipo_documento     = $request->tipo_documento;
        $aprovador          = $request->aprovador;
        $areaTreinamento    = $request->areaTreinamento;
        $grupoDivulgacao    = $request->grupoDivulgacao;
        $grupoInteresse     = $request->grupoInteresse;
        $tituloDocumento    = $request->tituloDocumento;
        $validadeDocumento  = $request->validadeDocumento;
        $acao               = $request->action;

        return view('documentacao.define-documento', ['tipo_documento' => $tipo_documento, 'aprovador' => $aprovador, 'areaTreinamento' => $areaTreinamento, 'grupoDivulgacao' => $grupoDivulgacao, 
                                                        'grupoInteresse' => $grupoInteresse, 'tituloDocumento' => $tituloDocumento, 'validadeDocumento' => $validadeDocumento, 'acao' => $acao]);
    }


    public function saveAttachedDocument(Request $request) {
        
    }

}
