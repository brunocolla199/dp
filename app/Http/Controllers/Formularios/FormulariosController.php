<?php

namespace App\Http\Controllers\Formularios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormulariosController extends Controller
{
    
    public function index() {
        return view('formularios.index');
    }

}
