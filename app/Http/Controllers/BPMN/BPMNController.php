<?php

namespace App\Http\Controllers\BPMN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BPMNController extends Controller
{
    
    public function index() {
        return view('bpmn.index');
    }

}
