<?php

namespace App\Http\Controllers\Credenciamento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CredenciamentoController extends Controller
{
    
    public function index() {
        return view('credenciamento.index');
    }

}
