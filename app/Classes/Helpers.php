<?php

namespace App\Classes;

use Illuminate\Http\Request;
use App\Notificacao;
use App\NotificacaoFormulario;
use App\DadosDocumento;
use App\AreaInteresseDocumento;
use App\HistoricoDocumento;
use App\HistoricoFormulario;
use App\User;
use App\Configuracao;
use App\Classes\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Helpers {

    // Notificações
    function getNotifications($idUser) {
        $notificacoes = DB::table('notificacao')
                            ->join('documento',         'notificacao.documento_id',     '=', 'documento.id')
                            ->join('dados_documento',   'dados_documento.documento_id', '=', 'notificacao.documento_id')
                            ->select('notificacao.*', 
                                        'documento.id AS doc_id', 'documento.tipo_documento_id', 'documento.codigo', 
                                        'dados_documento.id AS dd_id'
                            )
                            ->where('notificacao.usuario_id', '=', $idUser)
                            ->where('notificacao.visualizada', '=', false)
                            ->orderBy('notificacao.created_at', 'desc')->get();
        
        $notificacoes_forms = DB::table('notificacao_formulario')
                            ->join('formulario', 'notificacao_formulario.formulario_id', '=', 'formulario.id')
                            ->select('notificacao_formulario.*', 'formulario.tipo_documento_id', 'formulario.id AS doc_id', 'formulario.codigo AS codigo')
                            ->where('notificacao_formulario.usuario_id', '=', $idUser)
                            ->where('notificacao_formulario.visualizada', '=', false)
                            ->orderBy('notificacao_formulario.created_at', 'desc')->get();

        $collect = $notificacoes->merge($notificacoes_forms);
        $sorted = $collect->sortByDesc('created_at');
    
        return $sorted;
    }

    function gravaNotificacao($texto, $necessitaInteracao, $idUser, $idDoc) {
        $notificacao = new Notificacao();
        $notificacao->texto                 = $texto;
        $notificacao->visualizada           = false;
        $notificacao->necessita_interacao   = $necessitaInteracao;
        $notificacao->usuario_id     	    = $idUser;
        $notificacao->documento_id     	    = $idDoc;
        $notificacao->save();
    }
    
    function gravaNotificacaoFormulario($texto, $necessitaInteracao, $idUser, $idForm) {
        $notificacao = new NotificacaoFormulario();
        $notificacao->texto                 = $texto;
        $notificacao->visualizada           = false;
        $notificacao->necessita_interacao   = $necessitaInteracao;
        $notificacao->usuario_id     	    = $idUser;
        $notificacao->formulario_id     	= $idForm;
        $notificacao->save();
    }

    function atualizaNotificacaoVisualizada($idNotificacao) {
        $notificacao = Notificacao::where('id', '=', $idNotificacao)->get();
        $notificacao[0]->visualizada = true;
        $notificacao[0]->save();
    }

    function atualizaNotificacaoFormVisualizada($idNotificacao) {
        $notificacao = NotificacaoFormulario::where('id', '=', $idNotificacao)->get();
        $notificacao[0]->visualizada = true;
        $notificacao[0]->save();
    }



    // Histórico
    function gravaHistoricoDocumento($texto, $idDoc) {
        $hDoc = new HistoricoDocumento();
        $hDoc->descricao                = $texto;
        $hDoc->id_usuario_responsavel   = Auth::user()->id;
        $hDoc->nome_usuario_responsavel = Auth::user()->name;
        $hDoc->documento_id             = $idDoc;
        $hDoc->save();
    }


    function getHistoricoDocumento($idDoc) {
        $hDoc = HistoricoDocumento::where('documento_id', '=', $idDoc)->get();
        return $hDoc;
    }


    function gravaHistoricoFormulario($texto, $idForm) {
        $hForm = new HistoricoFormulario();
        $hForm->descricao               = $texto;
        $hForm->id_usuario_responsavel  = Auth::user()->id;
        $hForm->nome_usuario_responsavel= Auth::user()->name;
        $hForm->formulario_id           = $idForm;
        $hForm->save();
    }



    // Documentos
    function getListAllReviewsDocument($nome) {
        // dd($nome);
        $arr = [];
        $files = Storage::disk('local')->allFiles("uploads/");
        foreach($files as $file) {
            $part1 = explode("uploads/", $file)[1];
            $final = explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $part1)[0];
            if($final == $nome) {
                $arr[] = $part1;
            }
        }
        return $arr;
    }



    // Verificações
    function checkPermissionsToApprove($etapa, $idDoc) {
        $dados_doc = DadosDocumento::where('documento_id', '=', $idDoc)->get();

        switch ($etapa) {
            case 1: // Elaborador
                # code...
                break;

            case 2: // Qualidade
                $idUsuarioAdminSetorQualidade = Configuracao::where('id', '=', 2)->get();
                if($dados_doc[0]->nivel_acesso == Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL) {
                    if(Auth::user()->id == $idUsuarioAdminSetorQualidade[0]->admin_setor_qualidade) return true;
                } else {
                    return true;
                }
                break;

            case 3: // Área de Interesse
                $usuariosAreaInteresseDocumento = AreaInteresseDocumento::where('documento_id', '=', $idDoc)->get()->pluck('usuario_id');
                foreach ($usuariosAreaInteresseDocumento as $key => $idUser) {
                    if (Auth::user()->id == $idUser) return true;
                }
                break;

            case 4: // Aprovadores            
                $usuariosAprovadoresDocumentoAtual = User::select('users.id', 'users.name')
                                                            ->join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                            ->where('aprovador_setor.setor_id', '=', $dados_doc[0]->setor_id)
                                                            ->get()
                                                            ->pluck('name', 'id')
                                                            ->toArray();
                
                if( in_array(Auth::user()->id, array_keys($usuariosAprovadoresDocumentoAtual)) ) return true;
                break;
            
            default: // (7) Capital Humano
                # code...
                break;
        }

        return false;
    }



    /*** AWS S3 ***/
    public function getFormulariosAWS($key){
        $key = 'formularios/'.$key;
        $s3 = \Storage::disk('s3');
        $client = $s3->getDriver()->getAdapter()->getClient();
        $bucket = \Config::get('filesystems.disks.s3.bucket');
        
        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $key,
            'ResponseContentDisposition' => 'attachment; filename='.$key
        ]);
        
        $aws_req = $client->createPresignedRequest($command, '+1 minutes');
        return (string) $aws_req->getUri();
    }

    public function getListaPresenca($key){
        $key = 'lists/'.$key;
        $s3 = \Storage::disk('s3');
        $client = $s3->getDriver()->getAdapter()->getClient();
        $bucket = \Config::get('filesystems.disks.s3.bucket');
        
        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $key,
            'ResponseContentDisposition' => 'attachment; filename='.$key
        ]);
        
        $aws_req = $client->createPresignedRequest($command, '+1 minutes');
        return (string) $aws_req->getUri();
    }

    public function getAnexoAWSS3($filename) {
        $key = 'anexos/'.$filename;
        $s3 = \Storage::disk('s3');
        $client = $s3->getDriver()->getAdapter()->getClient();
        $bucket = \Config::get('filesystems.disks.s3.bucket');
        
        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $key,
            'ResponseContentDisposition' => 'attachment; filename='.$key
        ]);
        
        $aws_req = $client->createPresignedRequest($command, '+5 minutes');
        return rawurlencode((string) $aws_req->getUri());
    }


    /*** Validando Filenames  ***/
    public function escapeFilename($filename){
        return str_replace('/', '-', str_replace('"', '', str_replace('\'', '', str_replace('\\', '', $filename))));
    }

    public static function instance()  {
        return new Helpers();
    }

}