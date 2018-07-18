<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Setor;
use App\GrupoTreinamentoUsuario;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
 
    // Usuários
    public function getUsers(Request $request) {
        $users = User::orderBy('name')->get()->pluck('name', 'id');
        return response()->json(['response' => $users]);
    }
    

    public function trocarSetor(Request $request){
        $usuario = User::where('id', '=', $request->user)->get();
        $usuario[0]->setor_id = $request->new_sector;
        $usuario[0]->save();

        return response()->json(['response' => "sucesso"]);
    }


    public function removerDoGrupo(Request $request) {
        $gtu = DB::table('grupo_treinamento_usuario')->where([
            ['grupo_id', '=', $request->id_grupo],
            ['usuario_id', '=', $request->id_user]
        ])->delete();
        
        return response()->json(['response' => 'delete_success']);
    }
    


    // Setores
    public function getSectors(Request $request) {
        $sectors = Setor::orderBy('nome')->get()->pluck('nome_sigla', 'id');
        return response()->json(['response' => $sectors]);
    }


    public function retornaSetoresExcetoUm(Request $request) {
        $setores = Setor::where('id', "!=", $request->id_setor)->orderBy('nome')->get()->pluck('nome', 'id');
        return response()->json(['response' => $setores]);
    }


}
