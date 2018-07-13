<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setor;
use App\Configuracao;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NumberDefaultRequest;
use Illuminate\Support\Facades\View;

class ConfiguracoesController extends Controller
{
    
    public function index() {
        $setores = DB::table('setor')
                        ->join('tipo_setor', 'tipo_setor.id', '=', 'setor.tipo_setor_id')
                        ->select('setor.*', 'tipo_setor.nome AS nome_tipo')
                        ->get();

        $numeroPadraoParaCodigo = Configuracao::all();

        return view('configuracoes.index', ['setores' => $setores, 'numeroPadraoParaCodigo' => $numeroPadraoParaCodigo[0]->numero_padrao_codigo]);
    }


    public function saveNumberDefault(NumberDefaultRequest $request) {
        $c = "0";

        if( strlen($request->numeroPadrao) < 4 ) {
            if( strlen($request->numeroPadrao) == 1 ) $c = "0";
            else if( strlen($request->numeroPadrao) == 2)  $c = "00";
            else $c = "000";
        } else {
            $c = "000.";
        }
        
        $config = Configuracao::where('id', '=', 1)->get();
        $config[0]->numero_padrao_codigo = $c;
        $config[0]->save();

        return redirect()->route('configuracoes')->with(['padrao_sucesso' => 'valor']);
    }

}
