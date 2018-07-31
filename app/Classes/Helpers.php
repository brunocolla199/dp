<?php

namespace App\Classes;

use Illuminate\Http\Request;
use App\Notificacao;
use App\NotificacaoFormulario;
use App\DadosDocumento;
use App\AreaInteresseDocumento;
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
        
        $notificacoes_forms = DB::table('notificacao_formulario')
                            ->join('formulario', 'notificacao_formulario.formulario_id', '=', 'formulario.id')
                            ->select('notificacao_formulario.*', 'formulario.tipo_documento_id', 'formulario.id AS doc_id', 'formulario.codigo AS codigo')
                            ->where('notificacao_formulario.usuario_id', '=', $idUser)
                            ->where('notificacao_formulario.visualizada', '=', false)
                            ->orderBy('notificacao_formulario.created_at', 'desc')->get();
    
        // return $notificacoes;
        return $notificacoes->merge($notificacoes_forms);
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
        $hDoc->descricao    = $texto;
        $hDoc->documento_id = $idDoc;
        $hDoc->save();
    }


    function gravaHistoricoFormulario($texto, $idForm) {
        $hForm = new HistoricoFormulario();
        $hForm->descricao    = $texto;
        $hForm->formulario_id = $idForm;
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

            case 4: // Aprovador
                if(Auth::user()->id == $dados_doc[0]->aprovador_id) return true;
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