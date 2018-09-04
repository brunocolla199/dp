<?php

namespace App\Http\Controllers\Documentacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GrupoTreinamento;
use App\GrupoDivulgacao;
use App\TipoDocumento;
use App\Documento;
use App\DadosDocumento;
use App\Setor;
use App\Classes\Constants;
use App\User;
use App\Workflow;
use App\Configuracao;
use App\AreaInteresseDocumento;
use App\Formulario;
use App\DocumentoFormulario;
use App\ListaPresenca;
use App\AprovadorSetor;
use App\Http\Requests\DadosNovoDocumentoRequest;
use App\Http\Requests\UploadDocumentRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailsJob;

class DocumentacaoController extends Controller
{
    
    public function index() {
        // Valores 'comuns' necessários
        $tipoDocumentos    = TipoDocumento::where('id', '<=', '3')->orderBy('nome_tipo')->get()->pluck('nome_tipo', 'id');
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $gruposTreinamento = GrupoTreinamento::orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $formularios       = Formulario::all()->pluck('nome', 'id');
        
        // Aprovadores
        $aprovadores = array();
        $aprovadoresSetorAtual = null;
        $setoresQuePossuemAprovadores = DB::table('aprovador_setor')
                                                ->select('setor_id')
                                                ->groupBy('setor_id')
                                                ->get();
        
        foreach ($setoresQuePossuemAprovadores as $key => $value) {
            $setor = Setor::where('id', '=', $value->setor_id)->get();
            
            $users = User::join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                            ->where('aprovador_setor.setor_id', '=', $value->setor_id)
                            ->get()->pluck('name', 'usuario_id')->toArray();

            $aprovadores[$setor[0]->nome] = $users;
        }
        
        $aprovadorSetorAtual = null;
        $nomeDoPrimeiroSetorQuePossuiAprovador = (count($aprovadores)>0) ? array_keys($aprovadores)[0] : null;
        if($nomeDoPrimeiroSetorQuePossuiAprovador != null) {
            $idPrimeiroAprovador = array_keys($aprovadores[$nomeDoPrimeiroSetorQuePossuiAprovador])[0];
            $aprovadorSetorAtual = User::join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                        ->where('aprovador_setor.usuario_id', '=', $idPrimeiroAprovador)
                                        ->get()
                                        ->pluck('name', 'id');
        }
    
        // Área de Interesse
        $setoresUsuarios = [];
        $todosSetores = Setor::where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->get();
        foreach($todosSetores as $key => $setor) {
            $arrUsers = [];
            $users = User::where('setor_id', '=', $setor->id)->get();
            foreach($users as $key => $user) {
                $arrUsers[$user->id] = $user->name;
            }
            $setoresUsuarios[$setor->nome] = $arrUsers;
        }

        // DOCUMENTOS já criados (para listagem)
        $documentos = $this->getDocumentsIndex();
        $docsNAOFinalizados = ( array_key_exists("nao_finalizados", $documentos) && count($documentos["nao_finalizados"]) > 0 )  ? $documentos["nao_finalizados"] : null;
        $docsFinalizados = ( array_key_exists("finalizados", $documentos) && count($documentos["finalizados"]) > 0 )  ? $documentos["finalizados"] : null;

        return view('documentacao.index', ['tipoDocumentos' => $tipoDocumentos, 
                                            'aprovadores' => $aprovadores, 'aprovadorSetorAtual' => $aprovadorSetorAtual,
                                            'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao, 
                                            'setores' => $setores, 
                                            'setoresUsuarios' => $setoresUsuarios, 
                                            'formularios' => $formularios,
                                            'documentos_nao_finalizados' => $docsNAOFinalizados, 'documentos_finalizados' => $docsFinalizados ]);
    }


    public function filterDocumentsIndex(Request $request) {
        // Valores 'comuns' necessários
        $tipoDocumentos    = TipoDocumento::where('id', '<=', '3')->orderBy('nome_tipo')->get()->pluck('nome_tipo', 'id');
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $gruposTreinamento = GrupoTreinamento::orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $formularios       = Formulario::all()->pluck('nome', 'id');

        // Aprovadores
        $aprovadores = array();
        $aprovadoresSetorAtual = array();
        $setoresQuePossuemAprovadores = DB::table('aprovador_setor')
                                                ->select('setor_id')
                                                ->groupBy('setor_id')
                                                ->get();
        
        foreach ($setoresQuePossuemAprovadores as $key => $value) {
            $setor = Setor::where('id', '=', $value->setor_id)->get();
            $users = AprovadorSetor::where('setor_id', '=', $value->setor_id)->get()->pluck('name', 'usuario_id')->toArray();
            $aprovadores[$setor[0]->nome] = $users;
        }

        $aprovadoresSetorAtual = User::join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                        ->where('aprovador_setor.setor_id', '=', array_keys($setores)[0])
                                        ->get()
                                        ->pluck('name', 'id');

        // Área de Interesse
        $setoresUsuarios = [];
        $todosSetores = Setor::where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->get();
        foreach($todosSetores as $key => $setor) {
            $arrUsers = [];
            $users = User::where('setor_id', '=', $setor->id)->get();
            foreach($users as $key => $user) {
                $arrUsers[$user->id] = $user->name;
            }
            $setoresUsuarios[$setor->nome] = $arrUsers;
        }

        // Documentos já criados (para listagem)
        $documentos  = $this->filterListDocuments($request->all()); 
        $docsNAOFinalizados = ( array_key_exists("nao_finalizados", $documentos) && count($documentos["nao_finalizados"]) > 0 )  ? $documentos["nao_finalizados"] : null;
        $docsFinalizados = ( array_key_exists("finalizados", $documentos) && count($documentos["finalizados"]) > 0 )  ? $documentos["finalizados"] : null;

        return view('documentacao.index', ['tipoDocumentos' => $tipoDocumentos, 
                                            'aprovadores' => $aprovadores, 'aprovadoresSetorAtual' => $aprovadoresSetorAtual,
                                            'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao, 
                                            'setores' => $setores, 
                                            'setoresUsuarios' => $setoresUsuarios, 
                                            'formularios' => $formularios,
                                            'documentos_nao_finalizados' => $docsNAOFinalizados, 'documentos_finalizados' => $docsFinalizados ]);
    }


    public function validateData(DadosNovoDocumentoRequest $request) { 
        
        $tituloDocumento = \App\Classes\Helpers::instance()->escapeFilename($request->tituloDocumento);

        $documentos = DB::table('documento')
                            ->whereRaw("split_part(nome, '".Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS."', 1) = '" .$tituloDocumento. "'")
                            ->get();

        if( $documentos->count() > 0 ) {
            return redirect()->route('documentacao')->with('document_name_already_exists', 'Já existe um documento no sistema com esse mesmo nome. Por favor, escolha outro!');
        } else {
            $setorDono               = $request->setor_dono_doc;
            $text_setorDono          = Setor::where('id', '=', $setorDono)->get();
    
            $tipo_documento          = $request->tipo_documento;
            $text_tipo_documento     = TipoDocumento::where('id', '=', $request->tipo_documento)->get();
    
            $nivelAcessoDocumento   = (  ($request->nivelAcessoDocumento == 0) ? Constants::$NIVEL_ACESSO_DOC_LIVRE : ( ($request->nivelAcessoDocumento == 1) ? Constants::$NIVEL_ACESSO_DOC_RESTRITO : Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL  )    );
    
            $aprovador               = $request->aprovador;
            $text_aprovador          = User::where('id', '=', $request->aprovador)->get();
    
            $grupoTreinamento        = $request->grupoTreinamento;
            $text_grupoTreinamento   = GrupoTreinamento::where('id', '=', $request->grupoTreinamento)->get();
    
            $grupoDivulgacao         = $request->grupoDivulgacao;
            $text_grupoDivulgacao    = GrupoDivulgacao::where('id', '=', $request->grupoDivulgacao)->get();
            
            $copiaControlada         = ($request->copiaControlada) ? true : false;
            $text_copiaControlada    = ($request->copiaControlada) ? 'Sim' : 'Não';
    
            $validadeDocumento       = $request->validadeDocumento;
    
            $acao                    = $request->action;
            $areaInteresse           = $request->areaInteresse;        
            
            $codigo_final = $text_tipo_documento[0]->sigla . "-";
            $codigo = 0;
    
            if($request->formulariosAtrelados){
                $formsIDs = array_map('intval', $request->formulariosAtrelados);   
                $text_formsAtrelados = Formulario::whereIn('id', $formsIDs)->get(['nome'])->implode('nome',', ');
            } else {
                $text_formsAtrelados = '';
            }
            
    
            // Define código do documento
            if($text_tipo_documento[0]->sigla == "IT") { // Incremento depende do setor (cada setor tem seu incremento)
                $qtdDocs = DB::table('documento')
                            ->join('dados_documento',   'dados_documento.documento_id', '=', 'documento.id')
                            ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                            ->select('documento.id')
                            ->where('documento.tipo_documento_id', '=', $tipo_documento)
                            ->where('dados_documento.setor_id', '=', $setorDono)
                            ->get()->count();
    
                if( count($qtdDocs) <= 0 )  {
                    $codigo = $this->buildCodDocument(1);
                } else { 
                    $codigo = $this->buildCodDocument($qtdDocs + 1);
                }
    
            } else { // Incremento único (independente de setor)
                $qtdDocs = DB::table('documento')
                            ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                            ->select('documento.id')
                            ->where('documento.tipo_documento_id', '=', $tipo_documento)
                            ->get()->count();
    
                if( count($qtdDocs) <= 0 )  {
                    $codigo = $this->buildCodDocument(1);
                } else { 
                    $codigo = $this->buildCodDocument($qtdDocs + 1);
                }
            }
    
            // Concatena e gera o código final
            $codigo_final .= ($text_tipo_documento[0]->sigla == "IT") ? $text_setorDono[0]->sigla . "-" : "";
            $codigo_final .= $codigo;

            //Copiando modelo de documento para ser editado!
            Storage::disk('speed_office')->put($tituloDocumento.".docx", File::get(public_path()."/doc_templates/".strtoupper($text_tipo_documento[0]->sigla)."/".strtoupper($text_tipo_documento[0]->sigla).".docx"));

            return view('documentacao.define-documento', ['tipo_documento' => $tipo_documento, 'text_tipo_documento' => $text_tipo_documento[0]->nome_tipo,
                                                            'nivelAcessoDocumento' => $nivelAcessoDocumento,
                                                            'aprovador' => $aprovador, 'text_aprovador' => $text_aprovador[0]->name,
                                                            'grupoTreinamento' => $grupoTreinamento, 'text_grupoTreinamento' => $text_grupoTreinamento[0]->nome, 
                                                            'grupoDivulgacao' => $grupoDivulgacao, 'text_grupoDivulgacao' => $text_grupoDivulgacao[0]->nome, 
                                                            'setorDono' => $setorDono, 'text_setorDono' => $text_setorDono[0]->nome, 
                                                            'copiaControlada' => $copiaControlada, 'text_copiaControlada' => $text_copiaControlada,
                                                            'tituloDocumento' => $tituloDocumento, 'codigoDocumento' => $codigo_final, 'validadeDocumento' => $validadeDocumento, 
                                                            'acao' => $acao, 'areaInteresse' => $areaInteresse, 'formsAtrelados'=>$request->formulariosAtrelados, 'text_formsAtrelados'=>$text_formsAtrelados ]);
        }

    }

    /*
    public function saveAttachedDocument(Request $request) { // USAR QUANDO TIVER TEMPO: UploadDocumentRequest
        $novoDocumento = $request->all();
        
        // Popular a tabela 'documento' e, em seguida, as tabelas: 'dados_dcumento', 'area_interesse_documento', 'workflow'
         //if (Input::file('doc_uploaded') != null) {
            $file = $request->file('doc_uploaded', 'local');
            $extensao = $file->getClientOriginalExtension();
            $titulo   = \App\Classes\Helpers::instance()->escapeFilename($novoDocumento['tituloDocumento']) . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . "00";
            $codigo   = $novoDocumento['codigoDocumento'];
            $path     = $file->storeAs('/uploads', $titulo . "." . $extensao, 'local');

            $documento = new Documento();
            $documento->nome                 = $titulo;
            $documento->codigo               = $codigo;
            $documento->extensao             = $extensao;
            $documento->tipo_documento_id    = $novoDocumento['tipo_documento'];
            $documento->save();
            
            // Populando a tabela DADOS_DOCUMENTO [Quando tiver tempo, verificar se deu certo a inserção do documento]
            $dados_documento = new DadosDocumento();
            $dados_documento->validade                          = $novoDocumento['validadeDocumento'];
            $dados_documento->status                            = true;
            $dados_documento->observacao                        = "Documento Novo";
            $dados_documento->copia_controlada                  = $novoDocumento['copiaControlada'];
            $dados_documento->nivel_acesso                      = $novoDocumento['nivel_acesso'];
            $dados_documento->necessita_revisao                 = false;
            $dados_documento->id_usuario_solicitante            = null;
            $dados_documento->revisao                           = "00";
            $dados_documento->justificativa_rejeicao_revisao    = null;
            $dados_documento->em_revisao                        = false;
            $dados_documento->justificativa_cancelar_revisao    = null;
            $dados_documento->finalizado                        = false;
            $dados_documento->setor_id                          = $novoDocumento['setor_dono_doc'];
            $dados_documento->grupo_treinamento_id              = $novoDocumento['grupoTreinamento'];
            $dados_documento->grupo_divulgacao_id               = $novoDocumento['grupoDivulgacao'];
            $dados_documento->elaborador_id                     = Auth::user()->id;
            $dados_documento->aprovador_id                      = $novoDocumento['id_aprovador'];
            $dados_documento->documento_id                      = $documento->id; // id que acabou de ser inserido no 'save' acima
            $dados_documento->save();
            
            // Populando a tabela de vinculação DOCUMENTO -> USUÁRIO
            if( isset($novoDocumento['areaInteresse']) && count($novoDocumento['areaInteresse']) > 0 ) {
                foreach($novoDocumento['areaInteresse'] as $key => $user) {
                    $areaInteresseDocumento = new AreaInteresseDocumento();
                    $areaInteresseDocumento->documento_id  = $documento->id;
                    $areaInteresseDocumento->usuario_id  = $user;
                    $areaInteresseDocumento->save();
                }
            }

            //Populando a tabela de vinculação Documento -> Formulários
            if( isset($novoDocumento['formsAtrelados']) && count($novoDocumento['formsAtrelados']) > 0 ) {
                foreach($novoDocumento['formsAtrelados'] as $key => $form) {
                    $documentoFormulario = new DocumentoFormulario();
                    $documentoFormulario->documento_id  = $documento->id;
                    $documentoFormulario->formulario_id = $form;
                    $documentoFormulario->save();
                }
            }

         //}
        
        return View::make('documentacao.define-documento', array('overlay_sucesso' => 'valor', 'docData'=>$novoDocumento['docData']));
    }
    */

    /*
    public function saveNewDocument(Request $request) {         
        
        $novoDocumento = $request->all();
        $titulo   =  \App\Classes\Helpers::instance()->escapeFilename($novoDocumento['tituloDocumento']);
        $codigo   = $novoDocumento['codigoDocumento']; 
        $extensao = 'docx';

        Storage::disk('local')->put('uploads/'. $titulo . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . '00.html', $novoDocumento['docData']); 

        $documento = new Documento();
        $documento->nome                 = $titulo . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . "00";

        $documento->codigo               = $codigo;
        $documento->extensao             = $extensao;
        $documento->tipo_documento_id    = $novoDocumento['tipo_documento'];
        $documento->save();
        
        // Populando a tabela DADOS_DOCUMENTO [Quando tiver tempo, verificar se deu certo a inserção do documento]
        $dados_documento = new DadosDocumento();
        $dados_documento->validade                          = $novoDocumento['validadeDocumento'];
        $dados_documento->status                            = true;
        $dados_documento->observacao                        = "Documento Novo";
        $dados_documento->copia_controlada                  = $novoDocumento['copiaControlada'];
        $dados_documento->nivel_acesso                      = $novoDocumento['nivel_acesso'];
        $dados_documento->necessita_revisao                 = false;
        $dados_documento->id_usuario_solicitante            = null;
        $dados_documento->revisao                           = "00";
        $dados_documento->justificativa_rejeicao_revisao    = null;
        $dados_documento->em_revisao                        = false;
        $dados_documento->justificativa_cancelar_revisao    = null;
        $dados_documento->finalizado                        = false;
        $dados_documento->setor_id                          = $novoDocumento['setor_dono_doc'];
        $dados_documento->grupo_treinamento_id              = $novoDocumento['grupoTreinamento'];
        $dados_documento->grupo_divulgacao_id               = $novoDocumento['grupoDivulgacao'];
        $dados_documento->elaborador_id                     = Auth::user()->id;
        $dados_documento->aprovador_id                      = $novoDocumento['id_aprovador'];
        $dados_documento->documento_id                      = $documento->id; // id que acabou de ser inserido no 'save' acima
        $dados_documento->save();
        
        // Populando a tabela de vinculação DOCUMENTO -> USUÁRIO
        if( isset($novoDocumento['areaInteresse']) && count($novoDocumento['areaInteresse']) > 0 ) {
            foreach($novoDocumento['areaInteresse'] as $key => $user) {
                $areaInteresseDocumento = new AreaInteresseDocumento();
                $areaInteresseDocumento->documento_id  = $documento->id;
                $areaInteresseDocumento->usuario_id  = $user;
                $areaInteresseDocumento->save();
            }
        }

        //Populando a tabela de vinculação Documento -> Formulários
        if( isset($novoDocumento['formsAtrelados']) && count($novoDocumento['formsAtrelados']) > 0 ) {
            foreach($novoDocumento['formsAtrelados'] as $key => $form) {
                $documentoFormulario = new DocumentoFormulario();
                $documentoFormulario->documento_id  = $documento->id;
                $documentoFormulario->formulario_id = $form;
                $documentoFormulario->save();
            }
        }

        return View::make('documentacao.define-documento', array('overlay_sucesso' => 'valor', 'docData'=>$novoDocumento['docData']));
    }
    */


    public function salvaAnexoElaboradorEIniciaWorkflow(Request $request) {
        $responsavelPelaAcao = User::join('setor', 'setor.id', '=', 'users.setor_id')->where('setor.id', '=', Auth::user()->setor_id)->where('users.id', '=', Auth::user()->id)->select('name', 'nome')->get();
        $documento = Documento::where('id', '=', $request->documento_id)->get();
        $tipoDocumento = TipoDocumento::where('id', '=', $documento[0]->tipo_documento_id)->get();

        $workflow = new Workflow();
        $workflow->etapa_num    = Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
        $workflow->etapa        = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
        $workflow->descricao    = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
        $workflow->justificativa= "";
        $workflow->documento_id = $request->documento_id; // id que acabou de ser inserido no 'save' na tabela de documento
        $workflow->save();

        // Gravar notificação para todos usuários do setor Qualidade sobre a importação do documento
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        if($request->acao == "import") {
            foreach ($usuariosSetorQualidade as $key => $user) {
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " foi importado e precisa ser revisado.", true, $user->id, $request->documento_id);
            }
        } else {            
            foreach ($usuariosSetorQualidade as $key => $user) {
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " foi emitido e necessita ser revisado.", true, $user->id, $request->documento_id);
            }
        }
            
        // [E-mail -> (4)]
        $icon = "info";
        $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " requer análise.";
        $labelF2 = "Tipo do Documento: "; $valueF2 = $tipoDocumento[0]->nome_tipo;
        $labelF3 = "Enviado por: "; $valueF3 = $responsavelPelaAcao[0]->name; $label2_F3 = ""; $value2_F3 = "";
        $this->dispatch(new SendEmailsJob($usuariosSetorQualidade, "Novo documento para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

        // Grava histórico do documento
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_EMISSAO, $request->documento_id);
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE, $request->documento_id);
        
        return View::make('documentacao.define-documento', array('overlay_sucesso' => 'valor', 'docData'=>''));
    }


    public function salvaVinculoFormulario(Request $request){
        // dd($request);
        //Populando a tabela de vinculação Documento -> Formulários
        if(isset($request->formulariosAtreladosDocs) && count($request->formulariosAtreladosDocs) > 0 ) {

            DocumentoFormulario::where('documento_id', $request->documento_id)->delete();

            foreach($request->formulariosAtreladosDocs as $key => $form) {
                $documentoFormulario = new DocumentoFormulario();
                $documentoFormulario->documento_id  = $request->documento_id;
                $documentoFormulario->formulario_id = $form;
                $documentoFormulario->save();
            }
        } else {
            DocumentoFormulario::where('documento_id', $request->documento_id)->delete();
        }
        
        return redirect()->route('documentacao')->with('link_success','message');
    }


    public function viewDocument(Request $request) {
        if( array_key_exists("notify_id", $request->all()) ) {
            \App\Classes\Helpers::instance()->atualizaNotificacaoVisualizada($request->notify_id);
        }

        $document_id = $request->document_id;
        
        $documento     = Documento::where('id', '=', $document_id)->get();
        $workflowDoc   = Workflow::where('documento_id', '=', $document_id)->get();
        $dadosDoc      = DadosDocumento::where('documento_id', '=', $document_id)->get();
        $tipoDocumento = TipoDocumento::where('id', '=', $documento[0]->tipo_documento_id)->get(['nome_tipo', 'sigla']);
        $formsDoc      = Formulario::join('documento_formulario', 'documento_formulario.formulario_id', '=', 'formulario.id')->where('documento_formulario.documento_id', '=', $document_id)->pluck('formulario.id as id');
        $listaPresenca = ListaPresenca::where('documento_id', '=', $document_id)->get();
        $formularios   = Formulario::all()->pluck('nome', 'id');
        $filePath = null;
        
        if( count($listaPresenca) > 0 ) $filePath = $listaPresenca[0]->nome.".".$listaPresenca[0]->extensao;        
        $storagePath = Storage::disk('speed_office')->getDriver()->getAdapter()->getPathPrefix();
        $docPath = $storagePath.$documento[0]->nome.".".$documento[0]->extensao;
        $documento->docData = "";
    
        return view('documentacao.view-document', array(
            'nome'=>explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0], 'tipo_doc'=>$tipoDocumento[0]->sigla, 'doc_date'=>$documento[0]->updated_at, 'docPath'=>$documento[0]->nome.".".$documento[0]->extensao, 'document_id'=>$document_id, 
            'codigo'=>$documento[0]->codigo, 'docData'=>$documento->docData, 'resp'=>false, 'etapa_doc'=>$workflowDoc[0]->etapa_num, 'elaborador_id'=>$dadosDoc[0]->elaborador_id, 
            'justificativa'=>$workflowDoc[0]->justificativa, 'extensao'=>$documento[0]->extensao, 'filePath'=>$filePath, 'finalizado'=>$dadosDoc[0]->finalizado, 'necessita_revisao'=>$dadosDoc[0]->necessita_revisao, 'id_usuario_solicitante'=>$dadosDoc[0]->id_usuario_solicitante, 
            'justificativa_rejeicao_revisao'=>$dadosDoc[0]->justificativa_rejeicao_revisao, 'em_revisao' => $dadosDoc[0]->em_revisao, 'justificativa_cancelar_revisao' => $dadosDoc[0]->justificativa_cancelar_revisao, 
            'validadeDoc' => $dadosDoc[0]->validade, 'formularios'=>$formularios, 'formsDoc'=>$formsDoc ));
    }

    
    public function saveEditDocument(Request $request){
        $document_id = $request->document_id;
        $documento = Documento::find($document_id);
        $workflowDoc   = Workflow::where('documento_id', '=', $document_id)->get();
        $dadosDoc      = DadosDocumento::where('documento_id', '=', $document_id)->get();
        $tipoDocumento = TipoDocumento::where('id', '=', $documento->tipo_documento_id)->get(['nome_tipo', 'sigla']);
        $documento->codigo = $request->codigoDocumento;
        $formularios   = Formulario::all()->pluck('nome', 'id');
        
        if(isset($request->formulariosAtreladosDocs) && count($request->formulariosAtreladosDocs) > 0 ) {
            
            DocumentoFormulario::where('documento_id', $request->document_id)->delete();
            
            foreach($request->formulariosAtreladosDocs as $key => $form) {
                $documentoFormulario = new DocumentoFormulario();
                $documentoFormulario->documento_id  = $document_id;
                $documentoFormulario->formulario_id = $form;
                $documentoFormulario->save();
            }
        } else {
            DocumentoFormulario::where('documento_id', $request->document_id)->delete();
        }
        
        if($documento->save()){
            
            $formsDoc = Formulario::join('documento_formulario', 'documento_formulario.formulario_id', '=', 'formulario.id')->where('documento_formulario.documento_id', '=', $document_id)->pluck('formulario.id as id');

            // Storage::disk('local')->put('uploads/'.$documento->nome.'.html', $request->docData);
                
            $docData = trim(json_encode($request->docData), '"');
            
            return view('documentacao.view-document', array(
                'nome'=>explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento->nome)[0], 'tipo_doc'=>$tipoDocumento[0]->sigla, 'doc_date'=>$documento->updated_at, 'docPath'=>$documento->nome.".".$documento->extensao, 'document_id'=>$document_id, 
                'codigo'=>$documento->codigo, 'docData'=>$docData, 'resp'=>['status'=>'success', 'msg'=>'Documento Atualizado!', 'title'=>'Sucesso!'], 'etapa_doc'=>$workflowDoc[0]->etapa_num, 'elaborador_id'=>$dadosDoc[0]->elaborador_id, 
                'justificativa'=>$workflowDoc[0]->justificativa, 'extensao'=>$documento->extensao, 'finalizado'=>$dadosDoc[0]->finalizado, 'necessita_revisao'=>$dadosDoc[0]->necessita_revisao, 'id_usuario_solicitante'=>$dadosDoc[0]->id_usuario_solicitante, 
                'justificativa_rejeicao_revisao'=>$dadosDoc[0]->justificativa_rejeicao_revisao, 'em_revisao' => $dadosDoc[0]->em_revisao, 'justificativa_cancelar_revisao' => $dadosDoc[0]->justificativa_cancelar_revisao, 
                'validadeDoc' => $dadosDoc[0]->validade, 'formularios'=>$formularios, 'formsDoc'=>$formsDoc));
        }

    }


    public function makeDocumentPdf($codigo){
        $documento      = Documento::where('id', '=', $codigo)->get();
        $tipoDocumento  = TipoDocumento::where('id', '=', $documento[0]->tipo_documento_id)->get(['nome_tipo', 'sigla']);
        // $dadosDocumento = DadosDocumento::join('users', 'users.id', '=', 'dados_documento.aprovador_id')->where('documento_id', '=', $documento[0]->tipo_documento_id)->get(['aprovador_id', 'users.name as aprovador', 'revisao']);
        $dadosDocumento = DadosDocumento::join('users', 'users.id', '=', 'dados_documento.aprovador_id')->where('documento_id', '=', $documento[0]->id)->get(['aprovador_id', 'users.name as aprovador', 'revisao']);
        $docHtmlContent = "";

        // dd($dadosDocumento);

        switch ($tipoDocumento[0]->sigla) {
            case 'DG':
                $docHtmlContent = '<!DOCTYPE html>
                                        <html>
                                            <head>
                                            <meta charset="UTF-8" />
                                            <title>'.$documento[0]->codigo.'</title>
                                            <style>
                                                [style="list-style-type: disc;"]{
                                                    list-style-image:url('.public_path('plugins/ckeditor-document-editor/images/arrow.png').'!important;
                                                }
                                                
                                                [style="list-style-type: circle;"]{
                                                    list-style-image:url('.public_path('plugins/ckeditor-document-editor/images/circle.png').'!important;
                                                }
                                                
                                                [style="list-style-type: square;"]{
                                                    list-style-image:url('.public_path('plugins/ckeditor-document-editor/images/check2.png').'!important;
                                                }

                                                '.file_get_contents(public_path('plugins/ckeditor-document-editor/css/speed-pdf-style.css')).'
                                            </style>
                                            </head>
                                        <body>
                                        <div id="header" style="width:800px; height:100px; border:2px solid #0e3d5e; padding:0 10px;">
                                            <table style="position:absolute; width:780px; top:30px; left:20px; text-align:right;" >
                                                <tbody>
                                                    <tr>
                                                        <td align="left">
                                                            <span style="color:#0e3d5e; font-size:14px; text-transform: uppercase;">
                                                                '.explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0].'
                                                            </span>
                                                        </td align="right">
                                                        <td>
                                                            <img width="140" height="50" src="'.public_path('doc_templates/PG/dp-logo.png').'">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>     
                                        </div>
                                        
                                        <div class="pg-first-page">

                                            <img width="819" height="580" src="'.public_path('/doc_templates/DG/first-page-bg.png').'">
                                            
                                            <div class="pg-heading-info">
                                                <br><br>
                                                <h2>'.explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0].'</h2>
                                            </div>

                                            <div class="pg-info">
                                                <table>
                                                    
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Aprovado por:</b> '.$dadosDocumento[0]->aprovador.' </td>
                                                            <td><b>Código:</b> '.$documento[0]->codigo.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Data:</b>'.date("d/m/Y", strtotime( $documento[0]->updated_at)).'</td>
                                                            <td><b>Revisão:</b> '.$dadosDocumento[0]->revisao.'</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>


                                        <div>
                                            '.Storage::get("uploads/".$documento[0]->nome.".html").'
                                        </div>
                                
                                        <footer class="pg-footer">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td align="left">
                                                            <b>Aprovado por:</b> '.$dadosDocumento[0]->aprovador.'<br> 
                                                            <b>Código:</b> '.$documento[0]->codigo.'
                                                        </td>
                                                        <td>
                                                            <b>Data:</b>'.date("d/m/Y", strtotime( $documento[0]->updated_at)).'<br>
                                                            <b>Revisão:</b> '.$dadosDocumento[0]->revisao.'
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td ></td>            
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="page-number"></div>
                                        </footer>
                                
                                        </body>
                                        </html>';
                
                break;
                
                case 'PG':
                    $docHtmlContent = '<!DOCTYPE html>
                                        <html>
                                            <head>
                                            <meta charset="UTF-8" />
                                            <title>'.$documento[0]->codigo.'</title>
                                            <style>
                                                '.file_get_contents(public_path('plugins/ckeditor-document-editor/css/speed-pdf-style.css')).'
                                            </style>
                                            </head>
                                        <body>
                                        <div id="header" style="width:800px; height:100px; border:2px solid #0e3d5e; padding:0 10px;">
                                            <table style="position:absolute; width:780px; top:30px; left:20px; text-align:right;" >
                                                <tbody>
                                                    <tr>
                                                        <td align="left">
                                                            <span style="color:#0e3d5e; text-transform: uppercase;">
                                                                <strong>'.explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0].'</strong>
                                                            </span>
                                                        </td align="right">
                                                        <td>
                                                            <img width="140" height="50" src="'.public_path('doc_templates/PG/dp-logo.png').'">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>     
                                        </div>
                                        
                                        <div class="pg-first-page">

                                            <img width="819" height="580" src="'.public_path('/doc_templates/PG/first-page-bg.png').'">
                                            
                                            <div class="pg-heading-info">
                                                <h1>'.explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0].'</h1>
                                            </div>

                                            <div class="pg-info">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Aprovado por:</b> '.$dadosDocumento[0]->aprovador.' </td>
                                                            <td><b>Código:</b> '.$documento[0]->codigo.'</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Data:</b>'.date("d/m/Y", strtotime( $documento[0]->updated_at)).'</td>
                                                            <td><b>Revisão:</b> '.$dadosDocumento[0]->revisao.'</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                            '.Storage::get("uploads/".$documento[0]->nome.".html").'
                                        </div>
                                
                                            <footer class="pg-footer">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td align="left">
                                                                <b>Aprovado por:</b> '.$dadosDocumento[0]->aprovador.'<br> 
                                                                <b>Código:</b> '.$documento[0]->codigo.'
                                                            </td>
                                                            <td>
                                                                <b>Data:</b>'.date("d/m/Y", strtotime( $documento[0]->updated_at)).'<br>
                                                                <b>Revisão:</b> '.$dadosDocumento[0]->revisao.'
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td ></td>            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="page-number"></div>
                                            </footer>
                                
                                        </body>
                                        </html>';
                
                break;
                
                case 'IT':
                    $docHtmlContent = '<!DOCTYPE html>
                                        <html>
                                            <head>
                                            <meta charset="UTF-8" />
                                            <title>'.$documento[0]->codigo.'</title>
                                            <style>
                                                '.file_get_contents(public_path('plugins/ckeditor-document-editor/css/speed-pdf-style.css')).'
                                                @page :first{
                                                    margin: 105px 50px 0px 50px;
                                                }
                                            </style>
                                            </head>
                                        <body>

                                        <footer style="font-size:10px;">
                                            <div class="page-number"></div>
                                            <img width="820" height="55" src="data:image/png;base64,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" >
                                        </footer>

                                        <div id="header">
                                            <img width="822" height="170" src="data:image/png;base64,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">
                                            <table style="position:absolute; top:30px; right:45px; width:450px; text-align:right;">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="3"><span class="text-small" style="color:#ffffff"><strong>INSTRUÇÃO DE TRABALHO</strong></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"><span class="text-small" style="color:#ffffff">'.explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0].'</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="text-small" style="color:#ffffff"><strong>Código: '.$documento[0]->codigo.' </strong></span></td>
                                                        <td><span class="text-small" style="color:#ffffff"><strong>Revisão: '.$dadosDocumento[0]->revisao.'</strong></span></td>
                                                        <td><span class="text-small" style="color:#ffffff"><strong>Data: '. date("d/m/Y", strtotime( $documento[0]->updated_at)).'</strong></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>     
                                        </div>
                                        
                                        <div id="content">
                                            '.Storage::get("uploads/".$documento[0]->nome.".html").'
                                        </div>

                                       
                                
                                        </body>
                                        </html>';
                break;
        }

        
        $docHtmlContent .= Storage::get("uploads/".$documento[0]->nome.".html");
        // echo $docHtmlContent;
        // dd(base_path());
        // exit();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML( str_replace('/ckfinder', '/var/www/html/ckfinder', $docHtmlContent));
        return $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->stream();
    
    }


    public function makeDocumentPdfFromName(Request $request){

        
        $nome      = $request->nome;
        $revisao   = explode(".html", explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $nome)[1])[0];
        $documento = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')->where('documento.id', '=', $request->document_id)->get();
        $aprovador = User::where('id', '=', $documento[0]->aprovador_id)->get();
        $docHtmlContent = "";
        
        $url = url('plugins/onlyoffice-php/doceditor.php?type=embedded&fileID=').$documento[0]->nome.".".$documento[0]->extensao;
        
        header('Location: '.$url);
        exit();
    }


    protected function extractHtmlDoc($html, $section){

        switch ($section) {
            case 'body':

            $lines  = explode("\n", $html);
            $isBody = false;
            $result = '';

            foreach ($lines as $key => $line){
                if($line == '<body>') $isBody = true;

                if($line == '</body>'){
                    $isBody = false;
                    $result .= $line;
                }
                
                if($isBody && $line !== '<p>&nbsp;</p>') $result .= str_replace("'", "\"", $line);
                
            }
            return $result;
                // return ;
                break;
            case 'head':
                break;
        }
    }


    protected function requestReview(Request $request) {
        $documento = Documento::where('id', '=', $request->document_id)->get();
        $dados_documento = DadosDocumento::where('documento_id', '=', $documento[0]->id)->get();
        
        $dados_documento[0]->observacao = Constants::$DESCRICAO_WORKFLOW_SOLICITACAO_DE_REVISAO;
        $dados_documento[0]->necessita_revisao = true;
        $dados_documento[0]->id_usuario_solicitante = Auth::user()->id;
        $dados_documento[0]->save();

        // Notificações
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        foreach ($usuariosSetorQualidade as $key => $user) {
            \App\Classes\Helpers::instance()->gravaNotificacao("Existe uma solicitação de revisão para o documento " . $documento[0]->codigo . ".", true, $user->id, $documento[0]->id);
        }

        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_SOLICITACAO_DE_REVISAO, $documento[0]->id);

        return redirect()->route('documentacao')->with('request_review_success', 'message');
    }


    protected function decidesOnReviewRequest(Request $request) {
        $decisao = $request->decisao;
        $idDoc = $request->documento_id;

        $documento = Documento::where('id', '=', $idDoc)->get();
        $dadosDoc  = DadosDocumento::where('documento_id', '=', $idDoc)->get();
        $workflow  = Workflow::where('documento_id', '=', $idDoc)->get();

        if($decisao == "aprovar") {
            $revisaoAtual = $dadosDoc[0]->revisao;
            $revisaoNova = (int) $revisaoAtual + 1;
            $revisaoNova = ($revisaoNova <= 9) ? "0{$revisaoNova}" : $revisaoNova;

            // Notificações
            $elaborador = User::where('id', '=', $dadosDoc[0]->elaborador_id)->get();
            $aprovador = User::where('id', '=', $dadosDoc[0]->aprovador_id)->get();
            $usuarioSolicitanteRevisao = User::where('id', '=', $dadosDoc[0]->id_usuario_solicitante)->get();

            /* Elaborador não recebe mais notificação porque o usuário que solicitou a revisão se tornará o elaborador do documento */
            //\App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " iniciou a revisão " .$revisaoNova. " .", true, $dadosDoc[0]->elaborador_id, $idDoc);

            $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
            foreach ($usuariosSetorQualidade as $key => $user) {
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " teve a revisão " .$revisaoNova. " iniciada.", false, $user->id, $idDoc);
            }
            
            $usuariosAreaInteresseDocumento = AreaInteresseDocumento::where('documento_id', '=', $idDoc)->get();
            if( count($usuariosAreaInteresseDocumento) > 0 ) {
                foreach ($usuariosAreaInteresseDocumento as $key => $value) {
                    $user = User::where('id', '=', $value->usuario_id)->get();
                    if($user[0]->setor_id != Constants::$ID_SETOR_QUALIDADE) \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " teve a revisão " .$revisaoNova. " iniciada.", false, $value->usuario_id, $idDoc);
                }
            }
        
            if( $aprovador[0]->setor_id != Constants::$ID_SETOR_QUALIDADE  &&  !$usuariosAreaInteresseDocumento->contains('usuario_id', $aprovador[0]->id) ) {
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " teve a revisão " .$revisaoNova. " iniciada.", false, $dadosDoc[0]->aprovador_id, $idDoc);
            }

            if( $usuarioSolicitanteRevisao[0]->setor_id != Constants::$ID_SETOR_QUALIDADE  &&  !$usuariosAreaInteresseDocumento->contains('usuario_id', $usuarioSolicitanteRevisao[0]->id) ) {
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " iniciou a revisão " .$revisaoNova. " .", false, $dadosDoc[0]->id_usuario_solicitante, $idDoc);
            } 


            // Histórico
            \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_SOLICITACAO_DE_REVISAO_APROVADA, $idDoc);
            \App\Classes\Helpers::instance()->gravaHistoricoDocumento("Solicitação de revisão aprovada. Elaborador alterado de ". $elaborador[0]->name ." para ". $usuarioSolicitanteRevisao[0]->name .".", $idDoc);
            \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_EM_REVISAO, $idDoc);


            // dados_documento
            $dadosDoc[0]->elaborador_id = $usuarioSolicitanteRevisao[0]->id;
            $dadosDoc[0]->finalizado = false;
            $dadosDoc[0]->observacao = Constants::$DESCRICAO_WORKFLOW_SOLICITACAO_DE_REVISAO_APROVADA;
            $dadosDoc[0]->necessita_revisao = false;
            $dadosDoc[0]->revisao = $revisaoNova;
            $dadosDoc[0]->justificativa_rejeicao_revisao = null;
            $dadosDoc[0]->em_revisao = true;
            $dadosDoc[0]->save();

            // workflow
            $workflow[0]->etapa_num = Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM;
            $workflow[0]->etapa = Constants::$DESCRICAO_WORKFLOW_EM_REVISAO;
            $workflow[0]->save();


            // Criando uma cópia do documento original para a nova revisão (isso será usado quando quiser ver todas as versões do doc)
            if( Storage::disk('speed_office')->exists($documento[0]->nome.".".$documento[0]->extensao) ) {
                $newName = explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0] . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . $revisaoNova;
                Storage::disk('speed_office')->copy($documento[0]->nome.".".$documento[0]->extensao, $newName .".".$documento[0]->extensao);
                $documento[0]->nome = $newName;
                $documento[0]->save();
            }

            return redirect()->route('documentacao')->with('approves_request_review_success', 'message');

        } else if($decisao == "rejeitar") {
            $dadosDoc[0]->observacao = Constants::$DESCRICAO_WORKFLOW_SOLICITACAO_DE_REVISAO_REJEITADA;
            $dadosDoc[0]->necessita_revisao = false;
            $dadosDoc[0]->justificativa_rejeicao_revisao = $request->justificativaReprovacaoDaRequisicao;
            $dadosDoc[0]->save();

            // Notificações
            \App\Classes\Helpers::instance()->gravaNotificacao("A solicitação de revisão do documento " . $documento[0]->codigo . " foi rejeitada pelo setor Qualidade.", false, $dadosDoc[0]->id_usuario_solicitante, $documento[0]->id);

            // Histórico
            \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_SOLICITACAO_DE_REVISAO_REJEITADA, $documento[0]->id);

            return redirect()->route('documentacao')->with('reject_request_review_success', 'message');
        }
    }


    protected function cancelReview(Request $request) {
        $idDoc     = $request->documento_id;
        $documento = Documento::where('id', '=', $idDoc)->get();
        $dadosDoc  = DadosDocumento::where('documento_id', '=', $idDoc)->get();
        $workflow  = Workflow::where('documento_id', '=', $idDoc)->get();

        $nomeCompletoDoc = $documento[0]->nome;
        $nomeDoc = explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0];
        $revAtual = (int) explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[1];
        $revAtual_txt = explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[1];
        $revCorreta = $revAtual - 1;
        $revCorreta = ($revCorreta <= 9) ? "0{$revCorreta}" : $revCorreta;

        // < Documento >
        $documento[0]->nome  = $nomeDoc . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . $revCorreta;
        $documento[0]->save();

        // < DadosDocumento >
        $dadosDoc[0]->finalizado = true;
        $dadosDoc[0]->necessita_revisao = false;
        $dadosDoc[0]->revisao = $revCorreta;
        $dadosDoc[0]->justificativa_rejeicao_revisao = null;
        $dadosDoc[0]->em_revisao = false;
        $dadosDoc[0]->justificativa_cancelar_revisao = $request->justificativaCancelamentoRevisao;
        $dadosDoc[0]->save();

        // < Workflow > [Por prevenção, coloca na etapa 7 - pois isso não fará diferença enquanto o documento estiver como 'finalizado'] 
        $workflow[0]->etapa_num = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM;
        $workflow[0]->etapa = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_TEXT;
        $workflow[0]->save();

        // < Excluindo o arquivo físico da revisão que acabou de ser cancelada >
        Storage::disk('speed_office')->delete($nomeCompletoDoc.".".$documento[0]->extensao);

        // Notificações
        \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " teve a revisão " .$revAtual_txt. " cancelada pela Qualidade.", false, $dadosDoc[0]->elaborador_id, $idDoc);
        if($dadosDoc[0]->id_usuario_solicitante != $dadosDoc[0]->elaborador_id  && $dadosDoc[0]->id_usuario_solicitante != $dadosDoc[0]->aprovador_id) \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " teve a revisão " .$revAtual_txt. " cancelada pela Qualidade.", false, $dadosDoc[0]->id_usuario_solicitante, $idDoc);

        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        foreach ($usuariosSetorQualidade as $key => $user) {
            \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " teve a revisão " .$revAtual_txt. " cancelada pela Qualidade.", false, $user->id, $idDoc);
        }
        
        $usuariosAreaInteresseDocumento = AreaInteresseDocumento::where('documento_id', '=', $idDoc)->get()->pluck('usuario_id');
        if( count($usuariosAreaInteresseDocumento) > 0 ) {
            foreach ($usuariosAreaInteresseDocumento as $key => $value) {
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " teve a revisão " .$revAtual_txt. " cancelada pela Qualidade.", false, $value, $idDoc);
            }
        }
    
        \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " teve a revisão " .$revAtual_txt. " cancelada pela Qualidade.", false, $dadosDoc[0]->aprovador_id, $idDoc);

        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_REVISAO_CANCELADA_PARTE_1 . $revAtual_txt . Constants::$DESCRICAO_WORKFLOW_REVISAO_CANCELADA_PARTE_2, $idDoc);
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_RETORNA_REVISAO_ANTERIOR_PARTE_1 . $revCorreta . Constants::$DESCRICAO_WORKFLOW_RETORNA_REVISAO_ANTERIOR_PARTE_2, $idDoc);
        
        return redirect()->route('documentacao')->with('cancel_review_success', 'message');
    }


    public function makeObsoleteDoc(Request $request) {
       /*
        $dadosDoc = DadosDocumento::where('documento_id', '=', $request->doc_id)->first();
        $dadosDoc->obsoleto = true;
        // $dadosDoc->save();

        $vinculoComFormularios = DocumentoFormulario::where('documento_id', '=', $request->doc_id)->get();
        foreach ($vinculoComFormularios as $key => $value) {
            // $value->delete();
        }

       
        
        // return redirect()->route('documentacao')->with('make_obsolete_doc', 'msg');
        */
    }

    
    public function makeActiveDoc(Request $request) {
        /*
        $dadosDoc = DadosDocumento::where('documento_id', '=', $request->doc_id)->first();
        $dadosDoc->obsoleto = false;
        $dadosDoc->save();

        return redirect()->route('documentacao')->with('make_active_doc', 'msg');
        */
    }


    public function viewObsoleteDoc(Request $request) {
        /*
        $document_id = $request->document_id;
        
        $documento     = Documento::where('id', '=', $document_id)->get();
        $workflowDoc   = Workflow::where('documento_id', '=', $document_id)->get();
        $dadosDoc      = DadosDocumento::where('documento_id', '=', $document_id)->get();
        $tipoDocumento = TipoDocumento::where('id', '=', $documento[0]->tipo_documento_id)->get(['nome_tipo', 'sigla']);
        $formsDoc      = Formulario::join('documento_formulario', 'documento_formulario.formulario_id', '=', 'formulario.id')->where('documento_formulario.documento_id', '=', $document_id)->pluck('formulario.id as id');
        $listaPresenca = ListaPresenca::where('documento_id', '=', $document_id)->get();
        $formularios   = Formulario::all()->pluck('nome', 'id');
        $filePath = null;
        
        if( count($listaPresenca) > 0 ) $filePath = $listaPresenca[0]->nome.".".$listaPresenca[0]->extensao;        
        $storagePath = Storage::disk('speed_office')->getDriver()->getAdapter()->getPathPrefix();
        $docPath = $storagePath.$documento[0]->nome.".".$documento[0]->extensao;
        $documento->docData = "";
    
        return view('documentacao.view-obsolete-document', array(
            'nome'=>explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0], 'tipo_doc'=>$tipoDocumento[0]->sigla, 'doc_date'=>$documento[0]->updated_at, 'docPath'=>$documento[0]->nome.".".$documento[0]->extensao, 'document_id'=>$document_id, 
            'codigo'=>$documento[0]->codigo, 'docData'=>$documento->docData, 'resp'=>false, 'etapa_doc'=>$workflowDoc[0]->etapa_num, 'elaborador_id'=>$dadosDoc[0]->elaborador_id, 
            'justificativa'=>$workflowDoc[0]->justificativa, 'extensao'=>$documento[0]->extensao, 'filePath'=>$filePath, 'finalizado'=>$dadosDoc[0]->finalizado, 'necessita_revisao'=>$dadosDoc[0]->necessita_revisao, 'id_usuario_solicitante'=>$dadosDoc[0]->id_usuario_solicitante, 
            'justificativa_rejeicao_revisao'=>$dadosDoc[0]->justificativa_rejeicao_revisao, 'em_revisao' => $dadosDoc[0]->em_revisao, 'justificativa_cancelar_revisao' => $dadosDoc[0]->justificativa_cancelar_revisao, 
            'validadeDoc' => $dadosDoc[0]->validade, 'formularios'=>$formularios, 'formsDoc'=>$formsDoc ));
            */
    }



    /*
    *  WORKFLOW      
    */
    protected function approvalDocument(Request $request) {
        $responsavelPelaAcao = User::join('setor', 'setor.id', '=', 'users.setor_id')->where('setor.id', '=', Auth::user()->setor_id)->where('users.id', '=', Auth::user()->id)->select('name', 'nome')->get();
        $idDoc = $request->documento_id;

        $documento = Documento::where('id', '=', $idDoc)->get();
        $workflow_doc = Workflow::where('documento_id', '=', $idDoc)->get();
        $dados_doc = DadosDocumento::where('documento_id', '=', $idDoc)->get();
        $tipoDocumento = TipoDocumento::where('id', '=', $documento[0]->tipo_documento_id)->get();
        
        switch ($request->etapa_doc) {
            case 1: // Elaborador
                # code...
                break;

            case 2: // Qualidade
                $dados_doc[0]->observacao = "Aprovado pela Qualidade";
                $dados_doc[0]->save();

                $usuariosAreaInteresseDocumento = AreaInteresseDocumento::join('users', 'users.id', '=', 'area_interesse_documento.usuario_id')->where('documento_id', '=', $idDoc)->select('usuario_id', 'name', 'username', 'email', 'setor_id')->get();
                if( count($usuariosAreaInteresseDocumento) > 0  ) {
                    $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_AREA_DE_INTERESSE_NUM;
                    $workflow_doc[0]->etapa = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_INTERESSE;
                    $workflow_doc[0]->save();

                    // Notificações
                    $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
                    foreach ($usuariosSetorQualidade as $key => $user) {
                        \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " foi revisado e aprovado pela Qualidade.", false, $user->id, $idDoc);
                    }

                    foreach ($usuariosAreaInteresseDocumento as $key => $user) {
                        \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ser analisado.", true, $user->usuario_id, $idDoc);
                    }

                    // [E-mail -> (4)]
                    $icon = "info";
                    $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " requer análise.";
                    $labelF2 = "Tipo do Documento: "; $valueF2 = $tipoDocumento[0]->nome_tipo;
                    $labelF3 = "Enviado por: "; $valueF3 = $responsavelPelaAcao[0]->name; $label2_F3 = ""; $value2_F3 = "";
                    $this->dispatch(new SendEmailsJob($usuariosAreaInteresseDocumento, "Novo documento para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

                    // Histórico
                    \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_APROVADO_AREA_DE_QUALIDADE, $idDoc);
                    \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_INTERESSE, $idDoc);

                } else {
                    $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_APROVADOR_NUM;
                    $workflow_doc[0]->etapa = Constants::$DESCRICAO_WORKFLOW_ANALISE_APROVADOR;
                    $workflow_doc[0]->save();

                    // Notificações
                    $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
                    foreach ($usuariosSetorQualidade as $key => $user) {
                        \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " foi revisado e aprovado pela Qualidade.", false, $user->id, $idDoc);
                    }

                    \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ser analisado.", true, $dados_doc[0]->aprovador_id, $idDoc);

                    // [E-mail -> (4)]
                    $aprovador = User::where('id', '=', $dados_doc[0]->aprovador_id)->select('id', 'name', 'username', 'email', 'setor_id')->get();
                    $icon = "info";
                    $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " requer análise.";
                    $labelF2 = "Tipo do Documento: "; $valueF2 = $tipoDocumento[0]->nome_tipo;
                    $labelF3 = "Enviado por: "; $valueF3 = $responsavelPelaAcao[0]->name; $label2_F3 = ""; $value2_F3 = "";
                    $this->dispatch(new SendEmailsJob($aprovador, "Novo documento para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

                    // Histórico
                    \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_APROVADO_AREA_DE_QUALIDADE, $idDoc);
                    \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_ANALISE_APROVADOR, $idDoc);
                }
                break;

            case 3: // Área de Interesse
                $dados_doc[0]->observacao = "Aprovado pela Área de Interesse";
                $dados_doc[0]->save();

                $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_APROVADOR_NUM;
                $workflow_doc[0]->etapa = Constants::$ETAPA_WORKFLOW_APROVADOR_TEXT;
                $workflow_doc[0]->save();

                // Notificações
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ser analisado.", true, $dados_doc[0]->aprovador_id, $idDoc);

                // [E-mail -> (4)]
                $aprovador = User::where('id', '=', $dados_doc[0]->aprovador_id)->get();
                $icon = "info";
                $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " requer análise.";
                $labelF2 = "Tipo do Documento: "; $valueF2 = $tipoDocumento[0]->nome_tipo;
                $labelF3 = "Enviado por: "; $valueF3 = $responsavelPelaAcao[0]->name; $label2_F3 = ""; $value2_F3 = "";
                $this->dispatch(new SendEmailsJob($aprovador, "Novo documento para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_APROVADO_AREA_DE_INTERESSE, $idDoc);
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_ANALISE_APROVADOR, $idDoc);
                break;

            case 4: // Aprovador
                $dados_doc[0]->observacao = "Aprovado pelo Aprovador";
                $dados_doc[0]->save();

                $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_NUM;
                $workflow_doc[0]->etapa = Constants::$ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_TEXT;
                $workflow_doc[0]->save();

                // Notificações
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " necessita lista de presença.", true, $dados_doc[0]->elaborador_id, $idDoc);

                // Histórico
                if( $documento[0]->tipo_documento_id == Constants::$ID_TIPO_DOCUMENTO_DIRETRIZES_DE_GESTAO ) \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_APROVADO_DIRETORIA, $idDoc);
                else \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_APROVADO_GERENCIA, $idDoc);

                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_AGUARDANDO_LISTA_DE_PRESENCA, $idDoc);
                break;
            
            default: // (7) Capital Humano
                $dados_doc[0]->observacao = "Lista de Presença aprovada pelo Capital Humano";
                $dados_doc[0]->finalizado = true;
                $dados_doc[0]->save();

                // Notificações
                \App\Classes\Helpers::instance()->gravaNotificacao("O processo de elaboração do documento " . $documento[0]->codigo . " foi divulgado.", false, $dados_doc[0]->elaborador_id, $idDoc);

                $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->select('id', 'name', 'username', 'email', 'setor_id')->get();
                foreach ($usuariosSetorQualidade as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacao("O processo de elaboração do documento " . $documento[0]->codigo . " foi divulgado.", false, $user->id, $idDoc);
                }

                $usuariosAreaInteresseDocumento = User::join('area_interesse_documento', 'area_interesse_documento.usuario_id', '=', 'users.id')->where('area_interesse_documento.documento_id', '=', $idDoc)->select('users.id', 'name', 'username', 'email', 'setor_id')->get();
                if( count($usuariosAreaInteresseDocumento) > 0  ) {
                    foreach ($usuariosAreaInteresseDocumento as $key => $user) {
                        \App\Classes\Helpers::instance()->gravaNotificacao("O processo de elaboração do documento " . $documento[0]->codigo . " foi divulgado.", false, $user->id, $idDoc);
                    }
                }

                \App\Classes\Helpers::instance()->gravaNotificacao("O processo de elaboração do documento " . $documento[0]->codigo . " foi divulgado.", false, $dados_doc[0]->aprovador_id, $idDoc);

                $usuariosSetorCapitalHumano = User::where('setor_id', '=', Constants::$ID_SETOR_CAPITAL_HUMANO)->select('id', 'name', 'username', 'email', 'setor_id')->get();
                foreach ($usuariosSetorCapitalHumano as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacao("O processo de elaboração do documento " . $documento[0]->codigo . " foi divulgado.", false, $user->id, $idDoc);
                }

                // [E-mail -> (3)]  
                $elaborador = User::where('id', '=', $dados_doc[0]->elaborador_id)->select('id', 'name', 'username', 'email', 'setor_id')->get();
                $aprovador = User::where('id', '=', $dados_doc[0]->aprovador_id)->select('id', 'name', 'username', 'email', 'setor_id')->get();
                $setor = Setor::where('id', '=', $dados_doc[0]->setor_id)->select('nome')->get();
                $tipoDocumento = TipoDocumento::where('id', '=', $documento[0]->tipo_documento_id)->get();

                $mergeOne = $usuariosSetorQualidade->merge($usuariosSetorCapitalHumano);
                $mergeTwo = $mergeOne->merge($elaborador);
                $mergeThree = $mergeTwo->merge($aprovador);
                $allUsersInvolved = $mergeThree->merge($usuariosAreaInteresseDocumento);

                $icon = "success";
                $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " foi divulgado.";
                $labelF2 = "Setor do documento: "; $valueF2 = $setor[0]->nome;
                $labelF3 = "Nível de acesso do documento: "; $valueF3 = $dados_doc[0]->nivel_acesso; $label2_F3 = " / Tipo do documento: "; $value2_F3 = $tipoDocumento[0]->nome_tipo;
                $this->dispatch(new SendEmailsJob($allUsersInvolved, "Documento divulgado",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));


                // Notificação específica para documentos que possuem Cópia Controlada
                if($dados_doc[0]->copia_controlada) {
                    foreach ($usuariosSetorQualidade as $key => $user) {
                        \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " necessita de Cópia Controlada.", true, $user->id, $idDoc);
                    }

                    // [E-mail -> (5)]
                    $icon = "info";
                    $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " possui cópia controlada.";
                    $labelF2 = "Este documento necessita de "; $valueF2 = "cópia controlada";
                    $labelF3 = ""; $valueF3 = "Não esqueça!"; $label2_F3 = ""; $value2_F3 = "";
                    $this->dispatch(new SendEmailsJob($usuariosSetorQualidade, "Cópia controlada necessária",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));
                }

                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_APROVADO_CAPITAL_HUMANO, $idDoc);
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_DOCUMENTO_DIVULGADO, $idDoc);
                break;
        }

        return redirect()->route('documentacao')->with('approval_success', 'message');
    }


    protected function rejectDocument(Request $request) {
        $responsavelPelaAcao = User::join('setor', 'setor.id', '=', 'users.setor_id')->where('setor.id', '=', Auth::user()->setor_id)->where('users.id', '=', Auth::user()->id)->select('name', 'nome')->get();
        $idDoc = $request->documento_id;
        
        $documento = Documento::where('id', '=', $idDoc)->get();
        $workflow_doc = Workflow::where('documento_id', '=', $idDoc)->get();
        $dados_doc = DadosDocumento::where('documento_id', '=', $idDoc)->get();
        $elaborador = User::where('id', '=', $dados_doc[0]->elaborador_id)->select('id', 'name', 'username', 'email', 'setor_id')->get();
        
        switch ($request->etapa_doc) {
            case 1: // Elaborador
                # code...
                break;

            case 2: // Qualidade
                $dados_doc[0]->observacao = "Rejeitado pela Qualidade";
                $dados_doc[0]->save();

                $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM;
                $workflow_doc[0]->etapa = Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO;
                $workflow_doc[0]->justificativa = $request->justificativaReprovacaoDoc;
                $workflow_doc[0]->save();

                // Notificações
                $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
                foreach ($usuariosSetorQualidade as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " foi devolvido para correção pela Qualidade.", false, $user->id, $idDoc);
                }

                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ser corrigido (rejeitado pela Qualidade).", true, $dados_doc[0]->elaborador_id, $idDoc);


                // [E-mail -> (1)]  
                $icon = "error";
                $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " foi rejeitado.";
                $labelF2 = "Foram solicitadas mudanças no arquivo."; $valueF2 = " Visualize a justificativa!";
                $labelF3 = "Usuário solicitante: "; $valueF3 = $responsavelPelaAcao[0]->name; $label2_F3 = " / Solicitado por: "; $value2_F3 = "Setor " . $responsavelPelaAcao[0]->nome;
                $this->dispatch(new SendEmailsJob($elaborador, "Documento rejeitado",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));
                
                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_REJEITADO_QUALIDADE, $idDoc);
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO, $idDoc);
                break;

            case 3: // Área de Interesse
                $dados_doc[0]->observacao = "Rejeitado pela Área de Interesse";
                $dados_doc[0]->save();

                $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM;
                $workflow_doc[0]->etapa = Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO;
                $workflow_doc[0]->justificativa = $request->justificativaReprovacaoDoc;
                $workflow_doc[0]->save();

                // Notificações
                $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
                foreach ($usuariosSetorQualidade as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " foi devolvido para correção pela Área de Interesse.", false, $user->id, $idDoc);
                }

                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ser corrigido (rejeitado pela Área de Interesse).", true, $dados_doc[0]->elaborador_id, $idDoc);

                // [E-mail -> (1)]  
                $icon = "error";
                $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " foi rejeitado.";
                $labelF2 = "Foram solicitadas mudanças no arquivo."; $valueF2 = " Visualize a justificativa!";
                $labelF3 = "Usuário solicitante: "; $valueF3 = $responsavelPelaAcao[0]->name; $label2_F3 = " / Solicitado por: "; $value2_F3 = "Área de Interesse";
                $this->dispatch(new SendEmailsJob($elaborador, "Documento rejeitado",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_REJEITADO_AREA_INTERESSE, $idDoc);
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO, $idDoc);
                break;

            case 4: // Aprovador
                $dados_doc[0]->observacao = "Rejeitado pelo Aprovador";
                $dados_doc[0]->save();

                $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM;
                $workflow_doc[0]->etapa = Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO;
                $workflow_doc[0]->justificativa = $request->justificativaReprovacaoDoc;
                $workflow_doc[0]->save();

                // Notificações
                $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
                foreach ($usuariosSetorQualidade as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " foi devolvido para correção pelo Aprovador.", false, $user->id, $idDoc);
                }

                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ser corrigido (rejeitado pelo Aprovador).", true, $dados_doc[0]->elaborador_id, $idDoc);

                // [E-mail -> (1)]  
                $icon = "error";
                $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " foi rejeitado.";
                $labelF2 = "Foram solicitadas mudanças no arquivo."; $valueF2 = " Visualize a justificativa!";
                $labelF3 = "Usuário solicitante: "; $valueF3 = $responsavelPelaAcao[0]->name; $label2_F3 = " / Solicitado por: "; $value2_F3 = "Aprovador";
                $this->dispatch(new SendEmailsJob($elaborador, "Documento rejeitado",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_REJEITADO_APROVADOR, $idDoc);
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO, $idDoc);
                break;

            
            default: // (7) Capital Humano
                $dados_doc[0]->observacao = "Rejeitado pelo Capital Humano";
                $dados_doc[0]->save();

                $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_NUM;
                $workflow_doc[0]->etapa = Constants::$ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_TEXT;
                $workflow_doc[0]->justificativa = $request->justificativaReprovacaoLista;
                $workflow_doc[0]->save();

                // Notificações
                $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
                foreach ($usuariosSetorQualidade as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacao("A lista de presença do documento " . $documento[0]->codigo . " foi devolvida para correção pelo Capital Humano.", false, $user->id, $idDoc);
                }

                \App\Classes\Helpers::instance()->gravaNotificacao("A lista de presença do documento " . $documento[0]->codigo . " precisa ser corrigida (rejeitada pelo Capital Humano).", true, $dados_doc[0]->elaborador_id, $idDoc);

                // [E-mail -> (6)]  
                $icon = "error";
                $contentF1_P1 = "A lista de presença "; $codeF1 = ""; $contentF1_P2 = "foi rejeitada.";
                $labelF2 = "A rejeição foi realizada pelo setor: "; $valueF2 = $responsavelPelaAcao[0]->nome;
                $labelF3 = "Lista de presença vinculada ao documento: "; $valueF3 = $documento[0]->codigo; $label2_F3 = ""; $value2_F3 = "";
                $this->dispatch(new SendEmailsJob($elaborador, "Lista de presença rejeitada",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_REJEITADO_CAPITAL_HUMANO, $idDoc);
                \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO, $idDoc);

                return redirect()->route('documentacao')->with('reject_list_success', 'message');
                break;
        }

        return redirect()->route('documentacao')->with('reject_success', 'message');
    }


    protected function resendDocument(Request $request) {
        $responsavelPelaAcao = User::join('setor', 'setor.id', '=', 'users.setor_id')->where('setor.id', '=', Auth::user()->setor_id)->where('users.id', '=', Auth::user()->id)->select('name', 'nome')->get();
        $idDoc = $request->documento_id;

        $documento = Documento::where('id', '=', $idDoc)->get();
        $workflow_doc = Workflow::where('documento_id', '=', $idDoc)->get();
        $dados_doc = DadosDocumento::where('documento_id', '=', $idDoc)->get();

        $dados_doc[0]->observacao = "Reenviado pelo Elaborador";
        $dados_doc[0]->save();
        
        $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
        $workflow_doc[0]->etapa = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
        $workflow_doc[0]->justificativa = '';
        $workflow_doc[0]->save();

        // Notificações
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        foreach ($usuariosSetorQualidade as $key => $user) {
            \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ser analisado.", true, $user->id, $idDoc);
        }

        // [E-mail -> (4)]
        $tipoDocumento = TipoDocumento::where('id', '=', $documento[0]->tipo_documento_id)->get();
        $icon = "info";
        $contentF1_P1 = "O documento "; $codeF1 = $documento[0]->codigo; $contentF1_P2 = " requer análise.";
        $labelF2 = "Tipo do Documento: "; $valueF2 = $tipoDocumento[0]->nome_tipo;
        $labelF3 = "Enviado por: "; $valueF3 = $responsavelPelaAcao[0]->name; $label2_F3 = ""; $value2_F3 = "";
        $this->dispatch(new SendEmailsJob($usuariosSetorQualidade, "Novo documento para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_REENVIADO_COLABORADOR, $idDoc);
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE, $idDoc);

        return redirect()->route('documentacao')->with('resend_success', 'message');
    }


    protected function resendList(Request $request) {
        $idDoc = $request->documento_id;
        $documento = Documento::where('id', '=', $idDoc)->get();
        $workflow_doc = Workflow::where('documento_id', '=', $idDoc)->get();
        $dados_doc = DadosDocumento::where('documento_id', '=', $idDoc)->get();
        $request->nome_lista = \App\Classes\Helpers::instance()->escapeFilename($request->nome_lista);

        // Exclui Lista antiga
        Storage::disk('speed_office')->delete('lists/' . $request->nome_lista . "." . $request->extensao);
        
        // Salva nova lista de presença com o mesmo nome
        $file = $request->file('doc_uploaded', 'local');
        $extensao = $file->getClientOriginalExtension();

        Storage::disk('speed_office')->put('/lists/'.$request->nome_lista . ".".$extensao, file_get_contents($file), 'private');
        // $path = \App\Classes\Helpers::instance()->getListaPresenca($request->nome_lista.".".$extensao); 

        $dados_doc[0]->observacao = "Reenviado pelo Elaborador";
        $dados_doc[0]->save();
        
        $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM;
        $workflow_doc[0]->etapa = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_TEXT;
        $workflow_doc[0]->justificativa = '';
        $workflow_doc[0]->save();

        // Notificações
        $usuariosSetorCapitalHumano = User::where('setor_id', '=', Constants::$ID_SETOR_CAPITAL_HUMANO)->select('id', 'name', 'username', 'email', 'setor_id')->get();
        foreach ($usuariosSetorCapitalHumano as $key => $user) {
            \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ter a lista de presença reanalisada.", true, $user->id, $idDoc);
        }

        // [E-mail -> (7)]      
        $elaborador = User::where('id', '=', $dados_doc[0]->elaborador_id)->select('name')->get();
        $icon = "info";
        $contentF1_P1 = "A lista de presença"; $codeF1 = ""; $contentF1_P2 = " requer análise.";
        $labelF2 = "Elaborador do documento: "; $valueF2 = $elaborador[0]->name;
        $labelF3 = "Lista de presença vinculada ao documento: "; $valueF3 = $documento[0]->codigo; $label2_F3 = ""; $value2_F3 = "";
        $this->dispatch(new SendEmailsJob($usuariosSetorCapitalHumano, "Nova lista de presença para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_REENVIADO_COLABORADOR, $idDoc);
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_ANALISE_CAPITAL_HUMANO, $idDoc);

        return redirect()->route('documentacao')->with('resend_list_success', 'message');
    }


    public function salvaListaPresenca(Request $request) {
        $idDoc = $request->documento_id;
        $documento = Documento::where('id', '=', $idDoc)->get();
        $file = $request->file('doc_uploaded', 'local');
        $extensao = $file->getClientOriginalExtension();
        $request->nome_lista = \App\Classes\Helpers::instance()->escapeFilename($request->nome_lista);

        $listaPresenca = ListaPresenca::where('documento_id', '=', $idDoc)->get();
        if($listaPresenca->count() <= 0) {
            Storage::disk('speed_office')->put('/lists/'.$request->nome_lista . ".".$extensao, file_get_contents($file), 'private');
            $lista = new ListaPresenca();
            $lista->nome            = $request->nome_lista;
            $lista->extensao        = $extensao;
            $lista->descricao       = "Lista de Presença anexada";
            $lista->data            = date('d/m/Y');
            $lista->documento_id    = $idDoc;
            $lista->save();
    
            $dados_doc = DadosDocumento::where('documento_id', '=', $idDoc)->get();
            $dados_doc[0]->observacao = "Lista de Presença importada pelo elaborador";
            $dados_doc[0]->save();
    
            $workflow_doc = Workflow::where('documento_id', '=', $idDoc)->get();
            $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM;
            $workflow_doc[0]->etapa = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_TEXT;
            $workflow_doc[0]->save();
    
            // Notificações
            $usuariosSetorCapitalHumano = User::where('setor_id', '=', Constants::$ID_SETOR_CAPITAL_HUMANO)->select('id', 'name', 'username', 'email', 'setor_id')->get();
            foreach ($usuariosSetorCapitalHumano as $key => $user) {
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ter a lista de presença analisada.", true, $user->id, $idDoc);
            }

            // [E-mail -> (7)]      
            $elaborador = User::where('id', '=', $dados_doc[0]->elaborador_id)->select('name')->get();
            $icon = "info";
            $contentF1_P1 = "A lista de presença"; $codeF1 = ""; $contentF1_P2 = " requer análise.";
            $labelF2 = "Elaborador do documento: "; $valueF2 = $elaborador[0]->name;
            $labelF3 = "Lista de presença vinculada ao documento: "; $valueF3 = $documento[0]->codigo; $label2_F3 = ""; $value2_F3 = "";
            $this->dispatch(new SendEmailsJob($usuariosSetorCapitalHumano, "Nova lista de presença para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));
    
            // Histórico
            \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_ANALISE_CAPITAL_HUMANO, $idDoc);
        } else {
            // U => Estamos em uma revisão do documento e já existe lista de presença, ou seja, é necessário deletar a antiga e subir a nova

            // Exclui lista antiga
            Storage::disk('speed_office')->delete('lists/' . $listaPresenca[0]->nome .".". $listaPresenca[0]->extensao);

            // Salva lista nova
            Storage::disk('speed_office')->put('/lists/'.$request->nome_lista . ".". $extensao, file_get_contents($file), 'private');

            // Atualiza tabela no B.D.
            $listaPresenca[0]->nome      = $request->nome_lista;
            $listaPresenca[0]->extensao  = $extensao;
            $listaPresenca[0]->data      = date('d/m/Y');
            $listaPresenca[0]->save();

            $workflow_doc = Workflow::where('documento_id', '=', $idDoc)->get();
            $workflow_doc[0]->etapa_num = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM;
            $workflow_doc[0]->etapa = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_TEXT;
            $workflow_doc[0]->save();

            // Notificações
            $usuariosSetorCapitalHumano = User::where('setor_id', '=', Constants::$ID_SETOR_CAPITAL_HUMANO)->select('id', 'name', 'username', 'email', 'setor_id')->get();
            foreach ($usuariosSetorCapitalHumano as $key => $user) {
                \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento[0]->codigo . " precisa ter a lista de presença analisada.", true, $user->id, $idDoc);
            }

            // [E-mail -> (7)]      
            $elaborador = User::where('id', '=', $dados_doc[0]->elaborador_id)->select('name')->get();
            $icon = "info";
            $contentF1_P1 = "A lista de presença"; $codeF1 = ""; $contentF1_P2 = " requer análise.";
            $labelF2 = "Elaborador do documento: "; $valueF2 = $elaborador[0]->name;
            $labelF3 = "Lista de presença vinculada ao documento: "; $valueF3 = $documento[0]->codigo; $label2_F3 = ""; $value2_F3 = "";
            $this->dispatch(new SendEmailsJob($usuariosSetorCapitalHumano, "Nova lista de presença para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));
    
            // Histórico
            \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_ANALISE_CAPITAL_HUMANO, $idDoc);
        }

        return redirect()->route('documentacao')->with('import_list_success', 'message');
    }



    /*
    *  Úteis
    */
    public function buildCodDocument($n) {
        $padrao = Configuracao::where('id', '=', '1')->get()[0]->numero_padrao_codigo;
        $codigo = "0";

        if( strlen($padrao) == 1 ) {
            $codigo = $n;
        } else if( strlen($padrao) == 2 ) {
            // $codigo = ( strlen($n) <= 1 ) ? "0" + $n : $n;
            $codigo = ( strlen($n) <= 1 ) ? str_pad($n, 2, '0', STR_PAD_LEFT) : $n;      
        } else if( strlen($padrao) == 3 ) {
            if( strlen($n) <= 1 ) $codigo = str_pad($n, 3, '0', STR_PAD_LEFT);
            else if( strlen($n) == 2 ) $codigo = str_pad($n, 2, '0', STR_PAD_LEFT);
            else $codigo = $n;
        } else  {
            $valor = $n + ".01";

            if( strlen($n) <= 1 ) $codigo = str_pad($valor, 3, '0', STR_PAD_LEFT);
            else if( strlen($n) == 2 ) $codigo = str_pad($valor, 2, '0', STR_PAD_LEFT);
            else $codigo = $valor;
        }

        return $codigo;
    }


    public function filterListDocuments($req) {
        $list = null;
        $baseData = null;
        $documentos = $this->getDocumentsIndex();
        
        // Deixa os resultados em diferentes níveis hierárquicos
        $docsNAOFinalizados = ( array_key_exists("nao_finalizados", $documentos) && count($documentos["nao_finalizados"]) > 0 )  ? $documentos["nao_finalizados"] : null;
        $docsFinalizados = ( array_key_exists("finalizados", $documentos) && count($documentos["finalizados"]) > 0 )  ? $documentos["finalizados"] : null;

        // Filtros
        if(null == $req['search_tituloDocumento'] || "" == $req['search_tituloDocumento']) {
            $arr1 = array();
            $arr2 = array();
            
            if($docsNAOFinalizados != null) {
                foreach ($docsNAOFinalizados as $key => $value) {
                    $add = false;

                    if( $value->tipo_documento_id == $req['search_tipoDocumento']) { 
                        $add = true;           

                        /*
                        if($req['search_aprovador'] != null) {
                            if($value->aprovador_id == $req['search_aprovador']) $add = true;
                            else continue;
                        }
                        */
                        if($req['search_grupoTreinamento'] != null) {
                            if($value->grupo_treinamento_id == $req['search_grupoTreinamento']) $add = true;
                            else continue;
                        }
                        if($req['search_grupoDivulgacao'] != null) {
                            if($value->grupo_divulgacao_id == $req['search_grupoDivulgacao']) $add = true;
                            else continue;
                        }
                        if($req['search_validadeDocumento'] != null) {
                            $date = \DateTime::createFromFormat('d/n/Y', $req['search_validadeDocumento']);
                            $dateFmt = $date->format('Y-m-d');
                            
                            if($value->validade == $dateFmt) $add = true;
                            else continue;
                        }
                        if($req['search_setor'] != null) {
                            if($value->setor_id == $req['search_setor']) $add = true;
                            else continue;
                        }
                    } 

                    if($add) $arr1[] = $value; 
                }

                $list["nao_finalizados"] = $arr1;
            }

            if($docsFinalizados != null) {
                foreach ($docsFinalizados as $key => $value) {
                    $add = false;

                    if( $value->tipo_documento_id == $req['search_tipoDocumento']) {    
                        $add = true;
                        
                        /*
                        if($req['search_aprovador'] != null) {
                            if($value->aprovador_id == $req['search_aprovador']) $add = true;
                            else continue;
                        }
                        */
                        if($req['search_grupoTreinamento'] != null) {
                            if($value->grupo_treinamento_id == $req['search_grupoTreinamento']) $add = true;
                            else continue;
                        }
                        if($req['search_grupoDivulgacao'] != null) {
                            if($value->grupo_divulgacao_id == $req['search_grupoDivulgacao']) $add = true;
                            else continue;
                        }
                        if($req['search_validadeDocumento'] != null) {
                            $date = \DateTime::createFromFormat('d/n/Y', $req['search_validadeDocumento']);
                            $dateFmt = $date->format('Y-m-d');

                            if($value->validade == $dateFmt) $add = true;
                            else continue;
                        }
                        if($req['search_setor'] != null) {
                            if($value->setor_id == $req['search_setor']) $add = true;
                            else continue;
                        }
                    } 

                    if($add) $arr2[] = $value; 
                }

                $list["finalizados"] = $arr2;
            }

        } else {
            $arr1 = array();
            $arr2 = array();
            
            if($docsNAOFinalizados != null) {
                foreach ($docsNAOFinalizados as $key => $value) {
                    if( stripos($value->nome, $req['search_tituloDocumento']) !== false  ) {
                        $arr1[] = $value; 
                    }
                }
                $list["nao_finalizados"] = $arr1;
            }

            if($docsFinalizados != null) {
                foreach ($docsFinalizados as $key => $value) {
                    if( stripos($value->nome, $req['search_tituloDocumento']) !== false  ) {
                        $arr2[] = $value; 
                    }
                }
                $list["finalizados"] = $arr2;
            }
        }

        return $list;
    }


    public function getDocumentsIndex() {
        $idUsuarioAdminSetorQualidade = Configuracao::where('id', '=', 2)->get();
        $base_query = DB::table('documento')
                                ->join('dados_documento',           'dados_documento.documento_id',             '=',    'documento.id')
                                ->join('workflow',                  'workflow.documento_id',                    '=',    'documento.id')
                                ->join('tipo_documento',            'tipo_documento.id',                        '=',    'documento.tipo_documento_id') 
                                ->select('documento.*', 
                                        'dados_documento.id AS dd_id', 'dados_documento.validade', 'dados_documento.elaborador_id', 'dados_documento.aprovador_id', 'dados_documento.grupo_treinamento_id', 'dados_documento.grupo_divulgacao_id', 'dados_documento.setor_id', 'dados_documento.necessita_revisao', 'dados_documento.revisao', 'dados_documento.justificativa_rejeicao_revisao', 'dados_documento.obsoleto',
                                        'workflow.id AS wkf_id', 'workflow.etapa_num', 'workflow.etapa', 
                                        'tipo_documento.id AS tp_doc_id', 'tipo_documento.nome_tipo'
                                );


        $clonedBaseQuery2 = clone $base_query;
        $clonedBaseQuery3 = clone $base_query;
        $clonedBaseQuery4 = clone $base_query;
        $clonedBaseQuery5 = clone $base_query;
        $clonedBaseQuery6 = clone $base_query;
        $clonedBaseQuery7 = clone $base_query;
        $clonedBaseQuery8 = clone $base_query;
        $clonedBaseQuery9 = clone $base_query;
        $clonedBaseQuery10 = clone $base_query;

        $query_extra = DB::table('documento')
                            ->join('dados_documento',           'dados_documento.documento_id',             '=',    'documento.id')
                            ->join('workflow',                  'workflow.documento_id',                    '=',    'documento.id')
                            ->join('tipo_documento',            'tipo_documento.id',                        '=',    'documento.tipo_documento_id')
                            ->select('documento.*', 
                                    'dados_documento.id AS dd_id', 'dados_documento.validade', 'dados_documento.elaborador_id', 'dados_documento.aprovador_id', 'dados_documento.grupo_treinamento_id', 'dados_documento.grupo_divulgacao_id', 'dados_documento.setor_id', 'dados_documento.necessita_revisao', 'dados_documento.revisao', 'dados_documento.justificativa_rejeicao_revisao', 'dados_documento.obsoleto',
                                    'workflow.id AS wkf_id', 'workflow.etapa_num', 'workflow.etapa', 
                                    'tipo_documento.id AS tp_doc_id', 'tipo_documento.nome_tipo'
                            );
                            
        $clonedQueryExtra2 = clone $query_extra;
        $clonedQueryExtra3 = clone $query_extra;
        $clonedQueryExtra4 = clone $query_extra;        

        $documentos_NAOFinalizados = array(); 
        $documentosFinalizados = array(); 
        
        // A) Documentos não finalizados
        if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) {
            $documentos_NAOFinalizados_NAOConfidenciais;
            $documentos_NAOFinalizados_Confidenciais = array();
            
            $documentos_NAOFinalizados_NAOConfidenciais = $clonedBaseQuery2->where('dados_documento.finalizado', '=', false)
                                                                            ->where('dados_documento.nivel_acesso', '!=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                                            ->get();
                                                                        
            if(Auth::user()->id == $idUsuarioAdminSetorQualidade[0]->admin_setor_qualidade) {
                $documentos_NAOFinalizados_Confidenciais = $clonedBaseQuery3->where('dados_documento.finalizado', '=', false)
                                                                            ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                                            ->get();                                                        
            }

            if( count($documentos_NAOFinalizados_NAOConfidenciais) > 0 ) 
                for ($i=0; $i < count($documentos_NAOFinalizados_NAOConfidenciais); $i++) 
                    $documentos_NAOFinalizados[] = $documentos_NAOFinalizados_NAOConfidenciais[$i]; 


            if( count($documentos_NAOFinalizados_Confidenciais) > 0 ) 
                for ($i=0; $i < count($documentos_NAOFinalizados_Confidenciais); $i++) 
                    $documentos_NAOFinalizados[] = $documentos_NAOFinalizados_Confidenciais[$i]; 

        } else if( Auth::user()->setor_id != Constants::$ID_SETOR_QUALIDADE && Auth::user()->setor_id != Constants::$ID_SETOR_CAPITAL_HUMANO ) {

            $docs_etapa1 = $clonedBaseQuery4->where('dados_documento.finalizado', '=', false)
                                            ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM)
                                            ->where('dados_documento.elaborador_id', '=', Auth::user()->id)
                                            ->get();
            
            // Documentos na etapa 3 PRECISAM, OBRIGATORIAMENTE, possuir uma Área de Interesse para si (VER SLACK)
            $docs_etapa3 = $clonedQueryExtra2
                                ->where('dados_documento.finalizado', '=', false)
                                ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_AREA_DE_INTERESSE_NUM)
                                ->get();

            $aux_etapa3 = clone $docs_etapa3;
            foreach ($aux_etapa3 as $key => $value) {
                $usuariosDaAreaDeInteresseDoDocumento = AreaInteresseDocumento::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();
                
                if( !in_array(Auth::user()->id, $usuariosDaAreaDeInteresseDoDocumento) ) $docs_etapa3->forget($key);
            }


            $docs_etapa4 = $clonedBaseQuery5->where('dados_documento.finalizado', '=', false)
                                            ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_APROVADOR_NUM)
                                            ->get();
            
            $aux_etapa4 = clone $docs_etapa4;
            foreach ($aux_etapa4 as $key => $value) {              
                $usuariosAprovadores_etapa4 = User::select('users.id', 'users.name')
                                                    ->join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                    ->where('aprovador_setor.setor_id', '=', $value->setor_id)
                                                    ->get()
                                                    ->pluck('name', 'id')
                                                    ->toArray();
                
                if( !in_array(Auth::user()->id, array_keys($usuariosAprovadores_etapa4)) ) $docs_etapa4->forget($key);
            }



            $docs_etapas_5_6 = $clonedBaseQuery6->where('dados_documento.finalizado', '=', false)
                                                ->where(function ($query) {
                                                    $query->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_NUM)
                                                        ->orWhere('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_NUM);
                                                })
                                                ->where('dados_documento.elaborador_id', '=', Auth::user()->id)
                                                ->get();

            if( count($docs_etapa1) > 0 ) 
                for ($i=0; $i < count($docs_etapa1); $i++) 
                    $documentos_NAOFinalizados[] = $docs_etapa1[$i]; 

            if( $docs_etapa3->count() > 0 && count($docs_etapa3) > 0 ) 
                foreach($docs_etapa3 as $key => $value)
                    $documentos_NAOFinalizados[] = $value;  

            // if( $docs_etapa3->count() > 0 && count($docs_etapa3) > 0 ) 
            //     for ($i=0; $i < count($docs_etapa3); $i++) 
            //         $documentos_NAOFinalizados[] = $docs_etapa3[$i];    


            if( $docs_etapa4->count() > 0 && count($docs_etapa4) > 0 ) 
                foreach($docs_etapa4 as $key => $value)
                    $documentos_NAOFinalizados[] = $value; 

            // if( $docs_etapa4->count() > 0 && count($docs_etapa4) > 0 ) 
            //     for ($i=0; $i < count($docs_etapa4); $i++) 
            //         $documentos_NAOFinalizados[] = $docs_etapa4[$i]; 


            if( count($docs_etapas_5_6) > 0 ) 
                for ($i=0; $i < count($docs_etapas_5_6); $i++) 
                    $documentos_NAOFinalizados[] = $docs_etapas_5_6[$i]; 

            
        } else if(Auth::user()->setor_id == Constants::$ID_SETOR_CAPITAL_HUMANO) {
            $docs_etapa7 = $clonedBaseQuery7->where('dados_documento.finalizado', '=', false)
                                            ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM)
                                            ->get();

            if( count($docs_etapa7) > 0 ) 
                for ($i=0; $i < count($docs_etapa7); $i++) 
                    $documentos_NAOFinalizados[] = $docs_etapa7[$i];  
        }

        
        // B) Documentos finalizados
        $docsFinalizados_livres = $clonedBaseQuery8->where('dados_documento.finalizado', '=', true)
                                                    ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_LIVRE)
                                                    ->get();

        // Sorry about that, @zyadkhalil
        $docsFinalizados_restritos = array();
        if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) {
            $docsFinalizados_restritos = $clonedBaseQuery9->where('dados_documento.finalizado', '=', true)
                                                            ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_RESTRITO)
                                                            ->get();
        } else {
            $I_U = Auth::user()->id;
            $SI_U = Auth::user()->setor_id;
            $docsFinalizados_restritos = $clonedQueryExtra3->where('dados_documento.finalizado', '=', true)
                                                            ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_RESTRITO)
                                                            ->get();

            $aux_docsFinalizados_restritos = clone $docsFinalizados_restritos;
            foreach ($aux_docsFinalizados_restritos as $key => $value) {
                $usuariosDaAreaDeInteresseDoDocumento = AreaInteresseDocumento::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $usuariosAprovadoresDoSetorDonoDoDocumento = User::select('users.id', 'users.name')
                                                                    ->join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                                    ->where('aprovador_setor.setor_id', '=', $value->setor_id)
                                                                    ->get()
                                                                    ->pluck('name', 'id')
                                                                    ->toArray();
                
                // lista para todos os envolvidos na criação do doc (elaborador, qualidade, área de interesse e grupo de aprovadores) e para todos os membros do setor dono do documento
                if( $value->elaborador_id == $I_U  ||  $SI_U == Constants::$ID_SETOR_QUALIDADE  ||  in_array($I_U, $usuariosDaAreaDeInteresseDoDocumento)  ||  in_array($I_U, array_keys($usuariosAprovadoresDoSetorDonoDoDocumento))  ||  $SI_U == $value->setor_id ) {
                    continue;
                } else {
                    $docsFinalizados_restritos->forget($key);
                }
            }

        }

        $docsFinalizados_confidenciais = array();
        if(Auth::user()->id == $idUsuarioAdminSetorQualidade[0]->admin_setor_qualidade) {
            $docsFinalizados_confidenciais = $clonedBaseQuery10->where('dados_documento.finalizado', '=', true)
                                                                ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                                ->get();
        } else {
            $I_U = Auth::user()->id;
            $SI_U = Auth::user()->setor_id;
            $docsFinalizados_confidenciais = $clonedQueryExtra4->where('dados_documento.finalizado', '=', true)
                                                            ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                            ->get();

            $aux_docsFinalizados_confidenciais = clone $docsFinalizados_confidenciais;
            foreach ($aux_docsFinalizados_confidenciais as $key => $value) {
                $usuariosDaAreaDeInteresseDoDocumento = AreaInteresseDocumento::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $usuariosAprovadoresDoSetorDonoDoDocumento = User::select('users.id', 'users.name')
                                                                    ->join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                                    ->where('aprovador_setor.setor_id', '=', $value->setor_id)
                                                                    ->get()
                                                                    ->pluck('name', 'id')
                                                                    ->toArray();
                
                // Lista para o elaborador, para o usuário ADMIN da Qualidade, para todos os membros da área de interesse e para o grupo de aprovadores
                if( $value->elaborador_id == $I_U  ||  $I_U == $idUsuarioAdminSetorQualidade[0]->admin_setor_qualidade  ||  in_array($I_U, $usuariosDaAreaDeInteresseDoDocumento)  ||  in_array($I_U, array_keys($usuariosAprovadoresDoSetorDonoDoDocumento)) ) {
                    continue;
                } else {
                    $docsFinalizados_confidenciais->forget($key);
                }
            }

        }
        
        if( count($docsFinalizados_livres) > 0 ) 
            for ($i=0; $i < count($docsFinalizados_livres); $i++) 
                $documentosFinalizados[] = $docsFinalizados_livres[$i]; 

        if( $docsFinalizados_restritos->count() > 0 && count($docsFinalizados_restritos) > 0 ) 
            foreach($docsFinalizados_restritos as $key => $value)
                $documentosFinalizados[] = $value;  

        // if( $docsFinalizados_restritos->count() > 0 && count($docsFinalizados_restritos) > 0 ) 
        //     for ($i=0; $i < count($docsFinalizados_restritos); $i++) 
        //         $documentosFinalizados[] = $docsFinalizados_restritos[$i];  

        if( $docsFinalizados_confidenciais->count() > 0 && count($docsFinalizados_confidenciais) > 0 )     
            foreach($docsFinalizados_confidenciais as $key => $value)
                $documentosFinalizados[] = $value; 

        // if( $docsFinalizados_confidenciais->count() > 0 && count($docsFinalizados_confidenciais) > 0 ) 
        //     for ($i=0; $i < count($docsFinalizados_confidenciais); $i++) 
        //         $documentosFinalizados[] = $docsFinalizados_confidenciais[$i];  


        // Criando array final para a listagem de documentos
        $docs = array();
        if( count($documentos_NAOFinalizados) > 0 ) {
            usort($documentos_NAOFinalizados, array($this, "cmp"));
            $docs["nao_finalizados"] = $documentos_NAOFinalizados;
            
            //Adicionando formulários vinculados ao doc
            foreach ($docs['nao_finalizados'] as $key => &$value) {
                $value->formularios = Formulario::join('documento_formulario', 'documento_formulario.formulario_id', '=', 'formulario.id')->where('documento_formulario.documento_id', '=', $value->id)->pluck('formulario.id as id');
            }
        }

        if( count($documentosFinalizados) > 0 ) {
            usort($documentosFinalizados, array($this, "cmp"));
            $docs["finalizados"] = $documentosFinalizados;
            
            //Adicionando formulários vinculados ao doc
            foreach ($docs['finalizados'] as $key => &$value) {
                $value->formularios = Formulario::join('documento_formulario', 'documento_formulario.formulario_id', '=', 'formulario.id')->where('documento_formulario.documento_id', '=', $value->id)->pluck('formulario.id as id');
            }
        }
        return $docs;
    }


    private function cmp($a, $b) {
        return strcmp($a->nome, $b->nome);
    }

}
