<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Setor;
use App\GrupoTreinamentoUsuario;
use App\DocumentoObservacao;
use App\DadosDocumento;
use App\Anexo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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



    // Documentos
    public function salvaObservacao(Request $request) {
        $obs = new DocumentoObservacao();
        $obs->observacao                = $request->obs;
        $obs->nome_usuario_responsavel  = Auth::user()->name;
        $obs->documento_id              = $request->document_id;
        $obs->usuario_id                = Auth::user()->id;
        $obs->save();
        
        return response()->json(['response' => $request->all()]);
    }


    public function getObservacoes(Request $request) {
        $obs = DocumentoObservacao::where('documento_id', '=', $request->document_id)->orderBy('created_at', 'desc')->get()->toArray();

        return response()->json(['response' => $obs]);
    }


    public function okJustifyRejectRequest(Request $request) {
        $dadosDoc = DadosDocumento::where('documento_id', '=', $request->document_id)->get();
        $dadosDoc[0]->id_usuario_solicitante = null;
        $dadosDoc[0]->justificativa_rejeicao_revisao = null;
        $dadosDoc[0]->save();
        
        return response()->json(['response' => 'success']);    
    }


    public function okJustifyCancelRequest(Request $request) {
        $dadosDoc = DadosDocumento::where('documento_id', '=', $request->document_id)->get();
        $dadosDoc[0]->id_usuario_solicitante = null;
        $dadosDoc[0]->justificativa_cancelar_revisao = null;
        $dadosDoc[0]->save();
        
        return response()->json(['response' => 'success']);    
    }



    // Anexos
    public function saveAttachment(Request $request) {
        $file = $request->file('anexo_escolhido', 'local');
        $nome = $request->nome_anexo;

        $extensao  = $file->getClientOriginalExtension();
        $hash      = rand(000000000000000, 999999999999999);

        Storage::disk('s3')->put('/anexos/'.$hash . ".".$extensao, file_get_contents($file), 'private');

        $anexo = new Anexo();
        $anexo->nome = $nome;
        $anexo->hash = $hash;
        $anexo->extensao = $extensao;
        $anexo->documento_id = $request->document_id;
        $anexo->save();

        return response()->json(['response' => 'success']);  
    }


    public function getAnexos(Request $request) {
        $anexos = Anexo::where('documento_id', '=', $request->document_id)->get();
        foreach ($anexos as $key => $value) {
            $value['encodeFilePath'] = \App\Classes\Helpers::instance()->getAnexoAWSS3($value->hash .".". $value->extensao);
        }
        return response()->json(['response' => $anexos]);   
    }


    public function removeAttachment(Request $request) {
        $anexo = Anexo::where('id', '=', $request->anexo_id)->where('documento_id', '=', $request->documento_id)->get();
        $filename = $anexo[0]->hash . "." . $anexo[0]->extensao;

        Storage::disk('s3')->delete('anexos/' . $filename);
        $anexo[0]->delete();

        return response()->json(['response' => 'success']);  
    }

}
