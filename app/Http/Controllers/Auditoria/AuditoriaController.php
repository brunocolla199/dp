<?php

namespace App\Http\Controllers\Auditoria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    
    public function index() {
        return view('auditoria.index');
    }

}
