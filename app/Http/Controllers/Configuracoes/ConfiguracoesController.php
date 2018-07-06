<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoGrupo;
use App\Grupo;

class ConfiguracoesController extends Controller
{
    
    public function index() {
        $tiposDeGrupos = TipoGrupo::orderBy('nome')->get();
        $grupos        = Grupo::orderBy('nome')->get();
        return view('configuracoes.index', ['tiposDeGrupos' => $tiposDeGrupos, 'grupos' => $grupos]);
    }

}
