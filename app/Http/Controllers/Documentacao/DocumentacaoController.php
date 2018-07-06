<?php

namespace App\Http\Controllers\Documentacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoDocumento;

class DocumentacaoController extends Controller
{
    
    public function index() {
        $tipoDocumentos = TipoDocumento::orderBy('nome')->get()->pluck('nome', 'id');

        return view('documentacao.index', ['tipoDocumentos' => $tipoDocumentos]);
    }

}
