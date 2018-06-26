<?php

namespace App\Http\Controllers\Documentacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentacaoController extends Controller
{
    
    public function index() {
        return view('documentacao.index');
    }

}
