<?php

namespace App\Http\Controllers\Integracoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IntegracoesController extends Controller
{
    
    public function index() {
        return view('integracoes.index');
    }

}
