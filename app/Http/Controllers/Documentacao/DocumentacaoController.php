<?php

namespace App\Http\Controllers\Documentacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoDocumento;
use App\Setor;
use App\Classes\Constants;
use App\User;

class DocumentacaoController extends Controller
{
    
    public function index() {
        $tipoDocumentos = TipoDocumento::orderBy('nome')->get()->pluck('nome', 'id');
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'id');
        $gruposTreinamento = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_TREINAMENTO)->orderBy('nome')->get()->pluck('nome', 'id');
        $gruposDivulgacao  = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_DIVULGACAO)->orderBy('nome')->get()->pluck('nome', 'id');
        $aprovadores       = User::orderBy('name')->get()->pluck('name', 'id');
        $usuariosInteresse = User::orderBy('name')->get()->pluck('name', 'id');

        return view('documentacao.index', ['tipoDocumentos' => $tipoDocumentos, 'setores' => $setores, 'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao, 'aprovadores' => $aprovadores, 'usuariosInteresse' => $usuariosInteresse]);
    }

}
