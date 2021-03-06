<?php

namespace App\Classes;

use App\Classes\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Storage};
use App\{Notificacao, NotificacaoFormulario, DadosDocumento, AreaInteresseDocumento, HistoricoDocumento, HistoricoFormulario, Formulario, FormularioRevisao, User, Configuracao, OpcoesControleRegistros};

use Illuminate\Support\Facades\Mail;
use App\Mail\NecessitaRevisao;

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
        $arr = [];
        $files = Storage::disk('speed_office')->allFiles();
        foreach($files as $file) {
            $part1 = $file;
            $final = explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $part1)[0];
            if($final == $nome) {
                $arr[] = $part1;
            }
        }
        return $arr;
    }



    // Formulários
    function getNameListAllFormRevisions($id) {
        $revisoes = FormularioRevisao::where('formulario_id', '=', $id)->get()->pluck('nome_completo')->toArray();
        return $revisoes;
    }


    static function listEmailAddresses($_emailList) {
        $addressesText = explode('Lista de presença enviada para: ', $_emailList)[1];
        
        if(is_null($addressesText)) return '';

        $stylizedList = "";
        $addressesArr = explode(';', $addressesText);
        foreach ($addressesArr as $address) {
            if(!is_null($address) && $address != " ")  $stylizedList .= "<li><i class='fa fa-chevron-right'></i>$address</li>";
        }

        return $stylizedList;
    }


    static function updateFormNotifications($_oldCode, $_newCode, $_idForm) {
        
        if( $_oldCode != $_newCode ) {
            $notifications = NotificacaoFormulario::where('formulario_id', $_idForm)->where('texto', 'LIKE', "%$_oldCode%")->get();
            foreach ($notifications as $key => $notify) {
                $newText = str_replace($_oldCode, $_newCode, $notify->texto);
                $notify->texto = $newText;
                $notify->save();
            }
        }
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
                    if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE ) return true;
                    else return false;
                }
                break;

            case 3: // Área de Interesse
                $usuariosAreaInteresseDocumento = AreaInteresseDocumento::where('documento_id', '=', $idDoc)->get()->pluck('usuario_id');
                foreach ($usuariosAreaInteresseDocumento as $key => $idUser) {
                    if (Auth::user()->id == $idUser) return true;
                }
                break;

            case 4: // Aprovadores            
                if( Auth::user()->id == $dados_doc[0]->aprovador_id ) return true;
                break;
            
            default: // (7) Capital Humano
                # code...
                break;
        }

        return false;
    }



    // Controle de Registros
    static function getDescription($_id) {
        return OpcoesControleRegistros::find($_id)->descricao;
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
        
        $aws_req = $client->createPresignedRequest($command, '+2 minutes');
        return (string) $aws_req->getUri();
    }

    public function getFormulariosComURLEncodeAWS($key){
        $key = 'formularios/'.$key;
        $s3 = \Storage::disk('s3');
        $client = $s3->getDriver()->getAdapter()->getClient();
        $bucket = \Config::get('filesystems.disks.s3.bucket');
        
        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $key,
            'ResponseContentDisposition' => 'attachment; filename='.$key
        ]);
        
        $aws_req = $client->createPresignedRequest($command, '+2 minutes');
        return rawurlencode((string) $aws_req->getUri());
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
        return  str_replace('+', '-', 
                    str_replace('/', '-', 
                        str_replace('"', '', 
                            str_replace('\'', '', 
                                str_replace('\\', '', 
                                    str_replace('&', '-',$filename)
                                )
                            )
                        )
                    )
                );
    }




















    
    /*
    *   E M A I L S
    */
    
    // ----> Documentos

    // Documento foi rejeitado no Workflow e precisa ser corrigido
    public function sendDocumentoNecessitaSerCorrigido() {

    }

    // Documento irá vencer
    public function sendDocumentoVaiVencer() {

    }

    // O Workflow do documento foi finalizado (Revisão/Elaboração)
    public function sendDocumentoDivulgado() {

    }

    // O documento foi recebido e precisa ser analisado/revisado/aprovado
    public function sendDocumentoNecessitaRevisao($destinatarios, $documento, $responsavelPelaAcao) {
        $dataFile = [];
        $dataFile['codigo'] = $documento->codigo;
        $dataFile['nome'] = explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento->nome)[0];

        Mail::to($destinatarios)->send(new NecessitaRevisao($documento, $responsavelPelaAcao, "O documento", "Novo documento para aprovação"));
        return true;
    }

    // O documento possui cópia controlada
    public function sendDocumentoPossuiCopiaControlada() {

    }


    // ----> Listas de Presença

    // Lista de presença foi rejeitada pelo Capital Humano e deve ser readicionada
    public function sendListaDePresencaNecessitaSerReadicionada() {

    }

    // Existe uma nova lista de presença para ser analisada/revisada/aprovada
    public function sendListaDePresencaNecessitaRevisao($destinatarios, $lista, $responsavelPelaAcao) {
        $dataFile = [];
        $dataFile['codigo'] = $lista->nome;

        Mail::to($destinatarios)->send(new NecessitaRevisao($documento, $responsavelPelaAcao, "A lista de presença", "Nova lista de presença para aprovação"));
        return true;
    }


    // ----> Formulários

    // Formulário foi rejeitado no Workflow e precisa ser corrigido
    public function sendFormularioNecessitaSerCorrigido() {

    }

    // O Workflow do formulário foi finalizado (Revisão/Elaboração)
    public function sendFormularioDivulgado() {

    }




    
    public static function instance()  {
        return new Helpers();
    }


    public function nextCode($arquivo, $setor, $sigla = "", $tipoDoc = "")
    {
        if ($arquivo == "formulario") {
            $docsForms = Formulario::selectRaw("CAST(split_part(formulario.codigo, '-', 3) AS INTEGER ) AS cod")
            ->where('setor_id', $setor)->where('obsoleto', 'false')->orderBy('cod', 'asc')->get();
        } elseif ($arquivo == 'documento') {
            if ($sigla == "IT") {
                $docsForms = DB::table('documento')
                ->join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')
                ->join('tipo_documento', 'tipo_documento.id', '=', 'documento.tipo_documento_id')
                ->select('documento.id', 'documento.codigo')
                ->selectRaw("CAST(split_part(documento.codigo, '-', 3) AS INTEGER ) AS cod")
                ->where('documento.tipo_documento_id', '=', $tipoDoc)
                ->where('dados_documento.obsoleto', '=', 'false')
                ->where('dados_documento.setor_id', '=', $setor)
                ->orderBy('cod', 'asc')
                ->get();
            } else {
                $docsForms = DB::table('documento')
                ->join('tipo_documento', 'tipo_documento.id', '=', 'documento.tipo_documento_id')
                ->join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')
                ->select('documento.id', 'documento.codigo')
                ->selectRaw("CAST(split_part(documento.codigo, '-', 2) AS INTEGER ) AS cod")
                ->where('dados_documento.obsoleto', '=', 'false')
                ->where('documento.tipo_documento_id', '=', $tipoDoc)
                ->orderBy('cod', 'asc')
                ->get();
            }
        }

        $newCode = 1;
        foreach ($docsForms as $key => $docForm) {
            if ($newCode != $docForm->cod) {
                return $newCode;
            }
            $newCode++;
        }
        return $newCode;
    }
}
