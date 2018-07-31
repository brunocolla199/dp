<?php

namespace App\Classes;

use Illuminate\Http\Request;
use App\Notificacao;
use App\DadosDocumento;
use App\HistoricoDocumento;
use App\HistoricoFormulario;
use App\Classes\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        return $notificacoes;
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
    
    
    function atualizaNotificacaoVisualizada($idNotificacao) {
        $notificacao = Notificacao::where('id', '=', $idNotificacao)->get();
        $notificacao[0]->visualizada = true;
        $notificacao[0]->save();
    }



    // Histórico
    function gravaHistoricoDocumento($texto, $idDoc) {
        $hDoc = new HistoricoDocumento();
        $hDoc->descricao    = $texto;
        $hDoc->documento_id = $idDoc;
        $hDoc->save();
    }


    function gravaHistoricoFormulario($texto, $idForm) {
        $hForm = new HistoricoFormulario();
        $hForm->descricao    = $texto;
        $hForm->documento_id = $idDoc;
        $hForm->save();
    }




    // Verificações
    function checkPermissionsToApprove($etapa, $idDoc) {
        $dados_doc = DadosDocumento::where('documento_id', '=', $idDoc)->get();

        switch ($etapa) {
            case 1: // Elaborador
                # code...
                break;

            case 2: // Qualidade
                if($dados_doc[0]->nivel_acesso == Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL) {
                    if(Auth::user()->id == Constants::$ID_USUARIO_ADMIN_SETOR_QUALIDADE) return true;
                    else return false;
                } else {
                    return true;
                }
                break;

            case 3: // Área de Interesse
                # code...
                break;

            case 4: // Aprovador
                # code...
                break;

            case 5: // Upload da Lista de Presença
                # code...
                break;

            case 6: // Correção da Lista de Presença
                # code...
                break;
            
            default: // (7) Capital Humano
                # code...
                break;
        }

        return false;
    }





    public static function instance()  {
        return new Helpers();
    }

}