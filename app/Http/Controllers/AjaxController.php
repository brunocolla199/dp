<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Setor;
use App\GrupoTreinamentoUsuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $tipoGrupo = $request->tipo_grupo;
        
        if($tipoGrupo == "treinamento") {
            $gtu = DB::table('grupo_treinamento_usuario')->where([
                    ['grupo_id', '=', $request->id_grupo],
                    ['usuario_id', '=', $request->id_user]
            ])->delete();
        } else if($tipoGrupo == "divulgacao") {
            $gdu = DB::table('grupo_divulgacao_usuario')->where([
                ['grupo_id', '=', $request->id_grupo],
                ['usuario_id', '=', $request->id_user]
            ])->delete();
        } else if($tipoGrupo == "aprovadores") {
            $aprovSetor = DB::table('aprovador_setor')->where([
                ['usuario_id', '=', $request->id_user],
                ['setor_id', '=', $request->id_setor]
            ])->delete();
        }

        return response()->json(['response' => 'delete_success']);
    }


    public function getAprovadoresPorSetor(Request $request) {
        return response()->json(['response' => User::join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                ->where('aprovador_setor.setor_id', '=', $request->id)
                                                ->get()
                                                ->pluck('name', 'usuario_id') 
                                ]);
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


    //Uploads (Imagens Ckeditor)
    public function uploadEditorImage(Request $request){
        $files = $request->files->all();
        
        $file = $request->file()['upload'];
        $path = $file->store('public');           

        return response()->json([
            "uploaded"=> true,
            "url"=> Storage::url($path)
        ]);
    }
}
