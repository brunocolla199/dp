<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view('fornecedores.index', compact('fornecedores'));
    }


    public function create()
    {
        return view('fornecedores.create');
    }


    public function store(Request $request)
    {
        $fornecedor = new Fornecedor();
        $fornecedor->nome = $request->nome;
        $fornecedor->save();
        return redirect()->route('fornecedores.index');
    }


    public function edit(Request $request)
    {
        $fornecedor = Fornecedor::find($request->id);
        return view('fornecedores.update', compact('fornecedor'));
    }


    public function update(Request $request)
    {
        $fornecedor = Fornecedor::find($request->id);
        $fornecedor->nome = $request->nome;
        $fornecedor->save();
        return redirect()->route('fornecedores.index');
    }


    public function ativarInativar(Request $request)
    {
        $fornecedor = Fornecedor::find($request->fornecedor_id);
        $fornecedor->inativo = !$fornecedor->inativo;
        $fornecedor->save();
        return redirect()->route('fornecedores.index');
    }
}
