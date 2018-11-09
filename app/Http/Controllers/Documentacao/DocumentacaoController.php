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
use App\UsuarioExtra;
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
                $lastDoc = DB::table('documento')
                            ->join('dados_documento',   'dados_documento.documento_id', '=', 'documento.id')
                            ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                            ->select('documento.id', 'documento.codigo')
                            ->where('documento.tipo_documento_id', '=', $tipo_documento)
                            ->where('dados_documento.setor_id', '=', $setorDono)
                            ->orderBy('id', 'desc')
                            ->get()->first();

                if( empty($lastDoc) ) { // Ainda não existe documento para esse setor...
                    $codigo = $this->buildCodDocument(1);
                } else {
                    $arr = explode("-", $lastDoc->codigo);
                    if( count($arr) != 3) { // Houve algum erro ao criar o código do último documento desse setor...
                        $codigo = $this->buildCodDocument(1);
                    } else {
                        $lastCode = (int) $arr[2];
                        $codigo = $this->buildCodDocument($lastCode + 1);
                    }
                }

            } else { // Incremento único (independente de setor)
                $lastDoc2 = DB::table('documento')
                            ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                            ->select('documento.id', 'documento.codigo')
                            ->where('documento.tipo_documento_id', '=', $tipo_documento)
                            ->orderBy('id', 'desc')
                            ->get()->first();

                if( empty($lastDoc2) ) { // Ainda não existe documento deste tipo...
                    $codigo = $this->buildCodDocument(1);
                } else { 
                    $arr = explode("-", $lastDoc2->codigo);
                    if( count($arr) != 2) { // Houve algum erro ao criar o código do último documento desse tipo...
                        $codigo = $this->buildCodDocument(1);
                    } else {
                        $lastCode = (int) $arr[1];
                        $codigo = $this->buildCodDocument($lastCode + 1);
                    }
                }
            }

            // Concatena e gera o código final
            $codigo_final .= ($text_tipo_documento[0]->sigla == "IT") ? $text_setorDono[0]->sigla . "-" : "";
            $codigo_final .= $codigo;

            //Copiando modelo de documento para ser editado!
            Storage::disk('speed_office')->put($tituloDocumento . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . '00.docx', File::get(public_path()."/doc_templates/".strtoupper($text_tipo_documento[0]->sigla)."/".strtoupper($text_tipo_documento[0]->sigla).".docx"));

            return view('documentacao.define-documento', ['tipo_documento' => $tipo_documento, 'text_tipo_documento' => $text_tipo_documento[0]->nome_tipo,
                                                            'nivelAcessoDocumento' => $nivelAcessoDocumento,
                                                            'aprovador' => $aprovador, 'text_aprovador' => $text_aprovador[0]->name,
                                                            'grupoTreinamento' => $grupoTreinamento, 'text_grupoTreinamento' => $text_grupoTreinamento[0]->nome, 
                                                            'grupoDivulgacao' => $grupoDivulgacao, 'text_grupoDivulgacao' => $text_grupoDivulgacao[0]->nome, 
                                                            'setorDono' => $setorDono, 'text_setorDono' => $text_setorDono[0]->nome, 
                                                            'copiaControlada' => $copiaControlada, 'text_copiaControlada' => $text_copiaControlada,
                                                            'tituloDocumento' => $tituloDocumento, 'codigoDocumento' => $codigo_final, 'validadeDocumento' => $validadeDocumento, 
                                                            'acao' => $acao, 'areaInteresse' => $areaInteresse, 'formsAtrelados'=>$request->formulariosAtrelados, 'text_formsAtrelados'=>$text_formsAtrelados, 'docPath'=>$tituloDocumento.Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS.'00.docx' ]);
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


    private function defineVisualizacaoDaRevisaoAtualOuDaUltimaVigente($_idDocumento) {   
        $idUsuarioAdminSetorQualidade = Configuracao::where('id', '=', 2)->first();     
        $documento                    = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')->join('workflow', 'workflow.documento_id', '=', 'documento.id')->where('documento.id', '=', $_idDocumento)->first();
        $revisaoAtual                 = (int) $documento->revisao; // Esta coluna, caso o documento já esteja em processo de revisão, conterá o valor dessa revisão que está en andamento. EX: Última Rev Vigente: 05 / Se o documento está em processo de revisão, o valor dessa variável será = 6
        
        if( $revisaoAtual <= 0  ||  $documento->finalizado  ||  ( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE && $documento->nivel_acesso != Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL )  ||   ( $documento->nivel_acesso == Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL && Auth::user()->id == $idUsuarioAdminSetorQualidade->admin_setor_qualidade )  ) 
            return array('nomeFinal' => $documento->nome . "." . $documento->extensao, 'documentoEditavel' => true);


        $numRevisaoAnterior = $revisaoAtual - 1; 
        $revisaoAnterior    = ($revisaoAtual <= 10) ? "0{$numRevisaoAnterior}" : $numRevisaoAnterior;
        $nomeFinal          = explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento->nome)[0]  . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . $revisaoAnterior . "." . $documento->extensao;
        $documentoEditavel  = false;

        switch ($documento->etapa_num) {    
            case 1:
                if( $documento->elaborador_id == Auth::user()->id )  {
                    $nomeFinal = $documento->nome . "." . $documento->extensao;
                    $documentoEditavel  = true;
                }
                break;

            case 2:
                
                dd($idUsuarioAdminSetorQualidade);
                if($documento->nivel_acesso == Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL) {
                    if( Auth::user()->id == $idUsuarioAdminSetorQualidade->admin_setor_qualidade )  {
                        $nomeFinal = $documento->nome . "." . $documento->extensao;
                        $documentoEditavel  = true;
                    }
                } else {
                    if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE ) {
                        $nomeFinal = $documento->nome . "." . $documento->extensao;
                        $documentoEditavel  = true;
                    }
                }
                break;
            
            
            case 3:
                $usuariosAreaInteresseDocumento = AreaInteresseDocumento::where('documento_id', '=', $documento->id)->get()->pluck('usuario_id')->toArray();
                if( count($usuariosAreaInteresseDocumento) > 0 ) {
                    if( in_array(Auth::user()->id, $usuariosAreaInteresseDocumento) ) {
                        $nomeFinal = $documento->nome . "." . $documento->extensao;
                        $documentoEditavel  = true;
                    }
                }
                break;
            
            case 4:
                $aprovadoresDoSetorDonoDoDocumento = AprovadorSetor::join('users', 'users.id', '=', 'usuario_id')->where('aprovador_setor.setor_id', '=', $documento->setor_id)->get()->pluck('usuario_id')->toArray();
                if( count($aprovadoresDoSetorDonoDoDocumento) > 0 ) {
                    if( in_array(Auth::user()->id, $aprovadoresDoSetorDonoDoDocumento) ) {
                        $nomeFinal = $documento->nome . "." . $documento->extensao;
                        $documentoEditavel  = true;
                    }
                }
                break;

            case 5:
                if( $documento->elaborador_id == Auth::user()->id )  {
                    $nomeFinal = $documento->nome . "." . $documento->extensao;
                    $documentoEditavel  = true;
                }
                break;

            case 6:
                if( $documento->elaborador_id == Auth::user()->id )  {
                    $nomeFinal = $documento->nome . "." . $documento->extensao;
                    $documentoEditavel  = true;
                }
                break;
            
            default:
                break;
        }

        $arrRetorno = array('nomeFinal' => $nomeFinal, 'documentoEditavel' => $documentoEditavel);
        return $arrRetorno;
    }


    private function defineStatusDeListagemDoDocumento($_idDocumento) {        
        $documento = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')->join('workflow', 'workflow.documento_id', '=', 'documento.id')->where('documento.id', '=', $_idDocumento)->first();
        $status    = "Finalizado";
       
        switch ($documento->etapa_num) {     
            case 2:
                $idUsuarioAdminSetorQualidade = Configuracao::where('id', '=', 2)->first();
                if($documento->nivel_acesso == Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL) {
                    if( Auth::user()->id == $idUsuarioAdminSetorQualidade->admin_setor_qualidade ) $status = $documento->etapa;;
                } else {
                    if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE ) $status = $documento->etapa;;
                }
                break;
            
            case 3:
                $usuariosAreaInteresseDocumento = AreaInteresseDocumento::where('documento_id', '=', $documento->id)->get()->pluck('usuario_id')->toArray();
                if( count($usuariosAreaInteresseDocumento) > 0 ) {
                    if( in_array(Auth::user()->id, $usuariosAreaInteresseDocumento) ) {
                        $status = $documento->etapa;
                    }
                }
                break;
            
            case 4:
                $aprovadoresDoSetorDonoDoDocumento = AprovadorSetor::join('users', 'users.id', '=', 'usuario_id')->where('aprovador_setor.setor_id', '=', $documento->setor_id)->get()->pluck('usuario_id')->toArray();
                if( count($aprovadoresDoSetorDonoDoDocumento) > 0 ) {
                    if( in_array(Auth::user()->id, $aprovadoresDoSetorDonoDoDocumento) ) {
                        $status = $documento->etapa;
                    }
                }
                break;
            
            case 7:
                if( Auth::user()->setor_id == Constants::$ID_SETOR_CAPITAL_HUMANO ) {
                    $status = $documento->etapa;
                }
                break;
            
            default: // Etapas: 1, 5 e 6 (Elaborador, Upload Lista de Presença e Correção Lista de Presença)
                if( Auth::user()->id == $documento->elaborador_id ) {
                    $status = $documento->etapa;
                }
                break;
        }

        return $status;
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
        
        $storagePath              = Storage::disk('speed_office')->getDriver()->getAdapter()->getPathPrefix();
        $estadoDoDocumento        = $this->defineVisualizacaoDaRevisaoAtualOuDaUltimaVigente($document_id);
        $nomeDocumentoComExtensao = $estadoDoDocumento["nomeFinal"]; 
        $documentoEhEditavel      = $estadoDoDocumento['documentoEditavel']; 
        $docPath                  = $storagePath . $nomeDocumentoComExtensao;
        $documento->docData       = "";
    
        return view('documentacao.view-document', array(
            'nome'=>explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $documento[0]->nome)[0], 'tipo_doc'=>$tipoDocumento[0]->sigla, 'doc_date'=>$documento[0]->updated_at, 'docPath'=>$docPath, 'document_id'=>$document_id, 
            'codigo'=>$documento[0]->codigo, 'docData'=>$documento->docData, 'resp'=>false, 'etapa_doc'=>$workflowDoc[0]->etapa_num, 'elaborador_id'=>$dadosDoc[0]->elaborador_id, 
            'justificativa'=>$workflowDoc[0]->justificativa, 'extensao'=>$documento[0]->extensao, 'filePath'=>$filePath, 'finalizado'=>$dadosDoc[0]->finalizado, 'necessita_revisao'=>$dadosDoc[0]->necessita_revisao, 'id_usuario_solicitante'=>$dadosDoc[0]->id_usuario_solicitante, 
            'justificativa_rejeicao_revisao'=>$dadosDoc[0]->justificativa_rejeicao_revisao, 'em_revisao' => $dadosDoc[0]->em_revisao, 'justificativa_cancelar_revisao' => $dadosDoc[0]->justificativa_cancelar_revisao, 
            'validadeDoc' => $dadosDoc[0]->validade, 'formularios'=>$formularios, 'formsDoc'=>$formsDoc, 'documentoEhEditavel'=>$documentoEhEditavel ));
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
                'validadeDoc' => $dadosDoc[0]->validade, 'formularios'=>$formularios, 'formsDoc'=>$formsDoc, 'documentoEhEditavel'=>true));
        }

    }

    public function makeDocumentPdfFromName(Request $request){       
        $nome  = $request->nome;
        $url = url('plugins/onlyoffice-php/doceditor.php?type=embedded&fileID=').$nome;
        header('Location: '.$url);
        exit();
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
        $config = Configuracao::where('id', '=', 2)->get();
        $documento = Documento::where('id', '=', $request->doc_id)->first();
        $dadosDoc = DadosDocumento::where('documento_id', '=', $request->doc_id)->first();
        $dadosDoc->obsoleto = true;
        $dadosDoc->save();

        $vinculoComFormularios = DocumentoFormulario::where('documento_id', '=', $request->doc_id)->get();
        foreach ($vinculoComFormularios as $key => $value) {
            $value->delete();
        }

        
        // Notificações para todos os usuários envolvidos com o documento [Se for doc restrito, todos do setor tem que receber notificação? Se for doc confidencial, só o administrador da qualidade? Capital Humano deve receber?]
        $allUsersInvolved = null;
        $usuariosSetorQualidade = null;
        $usuariosSetorCapitalHumano = null;
        $usuariosAreaInteresseDocumento = null;

        $elaborador = User::where('id', '=', $dadosDoc->elaborador_id)->get();
        if($dadosDoc->elaborador_id != $dadosDoc->aprovador_id) {
            $aprovador = User::where('id', '=', $dadosDoc->aprovador_id)->get();
            $allUsersInvolved = $elaborador->merge($aprovador);
        } else {
            $allUsersInvolved = $elaborador;
        }

        if($dadosDoc->nivel_acesso !=  Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL ) {
            $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)
                                            ->where('users.id', '!=', $elaborador[0]->id)
                                            ->where('users.id', '!=', $dadosDoc->aprovador_id)
                                            ->select('id', 'name', 'username', 'email', 'setor_id')->get();
        } else {
            $usuariosSetorQualidade = User::where('id', '=', $config[0]->admin_setor_qualidade)
                                            ->where('users.id', '!=', $elaborador[0]->id)
                                            ->where('users.id', '!=', $dadosDoc->aprovador_id)
                                            ->select('id', 'name', 'username', 'email', 'setor_id')->get();
        }

        $usuariosSetorCapitalHumano = User::where('setor_id', '=', Constants::$ID_SETOR_CAPITAL_HUMANO)
                                            ->where('users.setor_id', '!=', Constants::$ID_SETOR_QUALIDADE)
                                            ->where('users.id', '!=', $elaborador[0]->id)
                                            ->where('users.id', '!=', $dadosDoc->aprovador_id)
                                            ->select('id', 'name', 'username', 'email', 'setor_id')->get();        
        
        $usuariosAreaInteresseDocumento = User::join('area_interesse_documento', 'area_interesse_documento.usuario_id', '=', 'users.id')
                                                ->where('area_interesse_documento.documento_id', '=', $request->doc_id)
                                                ->where('users.setor_id', '!=', Constants::$ID_SETOR_QUALIDADE)
                                                ->where('users.setor_id', '!=', Constants::$ID_SETOR_CAPITAL_HUMANO)
                                                ->where('users.id', '!=', $elaborador[0]->id)
                                                ->where('users.id', '!=', $dadosDoc->aprovador_id)
                                                ->select('users.id', 'name', 'username', 'email', 'setor_id')->get();

        
        if($usuariosSetorQualidade != null) $allUsersInvolved = $allUsersInvolved->merge($usuariosSetorQualidade);
        if($usuariosSetorCapitalHumano != null) $allUsersInvolved = $allUsersInvolved->merge($usuariosSetorCapitalHumano);
        if($usuariosAreaInteresseDocumento != null) $allUsersInvolved = $allUsersInvolved->merge($usuariosAreaInteresseDocumento);

        foreach ($allUsersInvolved as $key => $value) {
            \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $documento->codigo . " foi marcado como obsoleto.", false, $value->id, $documento->id);
        }
       

        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_DOC_MARCADO_COMO_OBSOLETO, $request->doc_id);

        return redirect()->route('documentacao')->with('make_obsolete_doc', 'msg');
    }

    
    public function makeActiveDoc(Request $request) {
        $dadosDoc = DadosDocumento::where('documento_id', '=', $request->doc_id)->first();
        $dadosDoc->obsoleto = false;
        $dadosDoc->save();

        return redirect()->route('documentacao')->with('make_active_doc', 'msg');
    }


    public function viewObsoleteDoc(Request $request) {
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
    }


    public function editInfo($id) {        
        // Documento
        $documento = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')
                                ->where('documento.id', '=', $id)
                                ->select('documento.id', 'nome', 'codigo', 'nivel_acesso', 'aprovador_id', 'grupo_treinamento_id', 'grupo_divulgacao_id', 'copia_controlada', 'validade', 'setor_id')->first();

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

        $usuariosAreaInteresseDocumento = AreaInteresseDocumento::join('users', 'users.id', '=', 'area_interesse_documento.usuario_id')
                                                                    ->where('documento_id', '=', $id)->select('usuario_id')->get()->pluck('usuario_id')->toArray();
        
        // Usuários Extras
        $usuariosExtraDocumento = UsuarioExtra::join('users', 'users.id', '=', 'usuario_extra.usuario_id')
                                                 ->where('usuario_extra.documento_id', '=', $id)->select('usuario_id')->get()->pluck('usuario_id')->toArray();

        // Aprovadores, Grupos de Interesse e de Divulgação
        $aprovadores = AprovadorSetor::join('users', 'users.id', '=', 'usuario_id')->where('aprovador_setor.setor_id', '=', $documento->setor_id)->get()->pluck('name', 'usuario_id')->toArray();
        $gruposTreinamento = GrupoTreinamento::orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id')->toArray();

        return view('documentacao.update-info', array( 'documento'=>$documento, 'usuariosAreaInteresseDocumento'=>$usuariosAreaInteresseDocumento, 'setoresUsuarios'=>$setoresUsuarios, 
                                                        'usuariosExtraDocumento'=>$usuariosExtraDocumento, 'aprovadores'=>$aprovadores, 'gruposTreinamento'=>$gruposTreinamento, 'gruposDivulgacao'=>$gruposDivulgacao  ) );
    }


    public function updateInfo(Request $request) {
        $idDoc = (int) $request->doc_id;
        $dadosDoc = DadosDocumento::where('documento_id', '=', $idDoc)->select('id', 'copia_controlada', 'aprovador_id', 'grupo_treinamento_id', 'grupo_divulgacao_id', 'validade')->first();
      
        // dados_documento
        $dadosDoc->copia_controlada = ($request->copiaControlada == "false") ? false : true;

        if($dadosDoc->aprovador_id != $request->aprovador) $dadosDoc->aprovador_id = $request->aprovador;
        
        if($dadosDoc->grupo_treinamento_id != $request->grupoTreinamento) $dadosDoc->grupo_treinamento_id = (int) $request->grupoTreinamento;
        
        if($dadosDoc->grupo_divulgacao_id != $request->grupoDivulgacao) $dadosDoc->grupo_divulgacao_id = (int) $request->grupoDivulgacao;
        
        $dadosDoc->validade = $request->validadeDocumento;
        $dadosDoc->save();


        // area_interesse_documento
        $deletedRows = AreaInteresseDocumento::where('documento_id', '=', $idDoc)->delete();
        $novaAreaInteresse = $request->areaInteresse;
        if( is_array($novaAreaInteresse) && count($novaAreaInteresse) > 0 ) {
            foreach($novaAreaInteresse as $key => $user) {
                $areaInteresseDocumento = new AreaInteresseDocumento();
                $areaInteresseDocumento->documento_id  = $idDoc;
                $areaInteresseDocumento->usuario_id  = $user;
                $areaInteresseDocumento->save();
            }
        }

        // usuario_extra
        $deletedRows2 = UsuarioExtra::where('documento_id', '=', $idDoc)->delete();
        $novosUsuariosExtra = $request->extraUsers;
        if( is_array($novosUsuariosExtra) && count($novosUsuariosExtra) > 0 ) {
            foreach($novosUsuariosExtra as $key => $user) {
                $usuarioExtra = new UsuarioExtra();
                $usuarioExtra->documento_id  = $idDoc;
                $usuarioExtra->usuario_id  = $user;
                $usuarioExtra->save();
            }
        }

        return redirect()->route('documentacao')->with('update_info_success', 'msg');
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
                $dados_doc[0]->observacao             = "Lista de Presença aprovada pelo Capital Humano";
                $dados_doc[0]->finalizado             = true;
                $dados_doc[0]->em_revisao             = false;
                $dados_doc[0]->id_usuario_solicitante = false;
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
            $dados_doc = DadosDocumento::where('documento_id', '=', $idDoc)->get();
            
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
            else if( strlen($n) == 2 ) $codigo = str_pad($n, 3, '0', STR_PAD_LEFT);
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


    private function cmp($a, $b) {
        return strcmp($a->nome, $b->nome);
    }


    public function importDocs(){

        $files_dg =  Storage::disk('local')->allfiles('uploads/DG/');
        $files_pg =  Storage::disk('local')->allfiles('uploads/PG/');
        $files_it =  Storage::disk('local')->allfiles('uploads/IT');
        
        $id_grupoDivulgacao  = 1;
        $id_grupoTreinamento = 1;

        // dd($files_dg);
        
        foreach($files_dg as $key => $file_d ){
            
            $titulo  = str_replace('.docx', '', explode('uploads/DG/', $file_d)[1]);
            $codigo  = explode(' ', $titulo)[0];
            $revisao = explode('Rev.', $titulo)[1];
            $titulo  = str_replace('Rev.', '_rev', $titulo);
            // echo ($titulo)."<br>";
            // echo ($codigo)."<br>";
            // echo ($revisao)."<br>";
            // dd($titulo);
        

            $documento = new Documento();
            $documento->nome                = $titulo;
            $documento->codigo              = $codigo;
            $documento->extensao            = 'docx';
            $documento->tipo_documento_id   = 3;
            $documento->save();

            $dados_documento = new DadosDocumento();
            $dados_documento->validade                          = '2018-08-29';
            $dados_documento->status                            = true;
            $dados_documento->observacao                        = "Documento Finalizado (Importação)";
            $dados_documento->copia_controlada                  = false;
            $dados_documento->nivel_acesso                      = 'Livre';
            $dados_documento->necessita_revisao                 = false;
            $dados_documento->id_usuario_solicitante            = null;
            $dados_documento->revisao                           = $revisao;
            $dados_documento->justificativa_rejeicao_revisao    = null;
            $dados_documento->em_revisao                        = false;
            $dados_documento->justificativa_cancelar_revisao    = null;
            $dados_documento->finalizado                        = true;
            $dados_documento->setor_id                          = 01;
            $dados_documento->grupo_treinamento_id              = $id_grupoTreinamento;
            $dados_documento->grupo_divulgacao_id               = $id_grupoDivulgacao;
            $dados_documento->elaborador_id                     = 1;
            $dados_documento->aprovador_id                      = 1;
            $dados_documento->documento_id                      = $documento->id; // id que acabou de ser inserido no 'save' acima
            $dados_documento->save();
            
            // dd($dados_documento);
            
            //WorkFlow
            $workflow = new Workflow();
            $workflow->etapa_num     = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM;
            $workflow->etapa         = "";
            $workflow->descricao     = "Documento Importado Rotina Speed";
            $workflow->justificativa = "";
            $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
            $workflow->save();

            //historico
            \App\Classes\Helpers::instance()->gravaHistoricoDocumento("Documento Importado", $documento->id);

            Storage::disk('speed_office')->put($titulo.".docx", Storage::disk('local')->get($file_d));
            
        }

        foreach($files_pg as $key => $file_p ){
            
            $titulo  = str_replace('.docx', '', explode('uploads/PG/', $file_p)[1]);
            $codigo  = explode(' ', $titulo)[0];
            $revisao = explode('Rev.', $titulo)[1];
            $titulo  = str_replace('Rev.', '_rev', $titulo);
           

            $documento = new Documento();
            $documento->nome                = $titulo;
            $documento->codigo              = $codigo;
            $documento->extensao            = 'docx';
            $documento->tipo_documento_id   = 2;
            $documento->save();

            $dados_documento = new DadosDocumento();
            $dados_documento->validade                          = '2018-08-29';
            $dados_documento->status                            = true;
            $dados_documento->observacao                        = "Documento Finalizado (Importação)";
            $dados_documento->copia_controlada                  = false;
            $dados_documento->nivel_acesso                      = 'Livre';
            $dados_documento->necessita_revisao                 = false;
            $dados_documento->id_usuario_solicitante            = null;
            $dados_documento->revisao                           = $revisao;
            $dados_documento->justificativa_rejeicao_revisao    = null;
            $dados_documento->em_revisao                        = false;
            $dados_documento->justificativa_cancelar_revisao    = null;
            $dados_documento->finalizado                        = true;
            $dados_documento->setor_id                          = 01;
            $dados_documento->grupo_treinamento_id              = $id_grupoTreinamento;
            $dados_documento->grupo_divulgacao_id               = $id_grupoDivulgacao;
            $dados_documento->elaborador_id                     = 1;
            $dados_documento->aprovador_id                      = 1;
            $dados_documento->documento_id                      = $documento->id; // id que acabou de ser inserido no 'save' acima
            $dados_documento->save();
            
            //WorkFlow
            $workflow = new Workflow();
            $workflow->etapa_num     = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM;
            $workflow->etapa         = "";
            $workflow->descricao     = "Documento Importado Rotina Speed";
            $workflow->justificativa = "";
            $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
            $workflow->save();

            //historico
            \App\Classes\Helpers::instance()->gravaHistoricoDocumento("Documento Importado", $documento->id);

            Storage::disk('speed_office')->put($titulo.".docx", Storage::disk('local')->get($file_p));
            
        }
        

        foreach($files_it as $key => $file_it){
            
            $titulo  = str_replace('.docx', '', explode('uploads/IT/', $file_it)[1]);

            $codigo  = explode(' ', $titulo)[0];
            $revisao = explode('Rev.', $titulo)[1];
            $titulo  = str_replace('Rev.', '_rev', $titulo);

            $documento = new Documento();
            $documento->nome                = $titulo;
            $documento->codigo              = $codigo;
            $documento->extensao            = 'docx';
            $documento->tipo_documento_id   = 1;
            $documento->save();

            $dados_documento = new DadosDocumento();
            $dados_documento->validade                          = '2018-08-29';
            $dados_documento->status                            = true;
            $dados_documento->observacao                        = "Documento Finalizado (Importação)";
            $dados_documento->copia_controlada                  = false;
            $dados_documento->nivel_acesso                      = 'Livre';
            $dados_documento->necessita_revisao                 = false;
            $dados_documento->id_usuario_solicitante            = null;
            $dados_documento->revisao                           = $revisao;
            $dados_documento->justificativa_rejeicao_revisao    = null;
            $dados_documento->em_revisao                        = false;
            $dados_documento->justificativa_cancelar_revisao    = null;
            $dados_documento->finalizado                        = true;
            $dados_documento->setor_id                          = 01;
            $dados_documento->grupo_treinamento_id              = $id_grupoTreinamento;
            $dados_documento->grupo_divulgacao_id               = $id_grupoDivulgacao;
            $dados_documento->elaborador_id                     = 1;
            $dados_documento->aprovador_id                      = 1;
            $dados_documento->documento_id                      = $documento->id; // id que acabou de ser inserido no 'save' acima
            $dados_documento->save();
            
            //WorkFlow
            $workflow = new Workflow();
            $workflow->etapa_num     = Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM;
            $workflow->etapa         = "";
            $workflow->descricao     = "Documento Importado Rotina Speed";
            $workflow->justificativa = "";
            $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
            $workflow->save();

            //Historico
            \App\Classes\Helpers::instance()->gravaHistoricoDocumento("Documento Importado", $documento->id);

            Storage::disk('speed_office')->put($titulo.".docx", Storage::disk('local')->get($file_it));
            
        }

        dd($files_it);
    }


    public function getDocumentsIndex() {
        // Criação da query base para a busca de todos os possíveis documentos que o usuário tem permissão de visualizar
        $base_query = DB::table('documento')
                                ->join('dados_documento',   'dados_documento.documento_id', '=',    'documento.id')
                                ->join('workflow',          'workflow.documento_id',        '=',    'documento.id')
                                ->join('tipo_documento',    'tipo_documento.id',            '=',    'documento.tipo_documento_id') 
                                ->select('documento.*', 
                                        'dados_documento.id AS dd_id', 'dados_documento.validade', 'dados_documento.elaborador_id', 'dados_documento.aprovador_id', 'dados_documento.grupo_treinamento_id', 'dados_documento.grupo_divulgacao_id', 'dados_documento.setor_id', 'dados_documento.necessita_revisao', 'dados_documento.revisao', 'dados_documento.justificativa_rejeicao_revisao', 'dados_documento.obsoleto', 'dados_documento.nivel_acesso',
                                        'workflow.id AS wkf_id', 'workflow.etapa_num', 'workflow.etapa', 
                                        'tipo_documento.id AS tp_doc_id', 'tipo_documento.nome_tipo'
                                );
                            
        // Realiza um controle da busca de documentos, começando pela hierarquia principal: documentos não finalizados e finalizados.
        $documentosEmProcessoDeCriacao = $this->getDocumentosEmProcessoDeCriacao($base_query);
        $documentosEmProcessoDeRevisao = $this->getDocumentosEmProcessoDeRevisao($base_query);
        $documentosFinalizados         = $this->getDocumentosFinalizados($base_query);

        
        // Criando array final para a listagem de documentos
        $docs = array();
        $documentos_NAOFinalizados = array_merge_recursive($documentosEmProcessoDeCriacao, $documentosEmProcessoDeRevisao);

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


    private function getDocumentosEmProcessoDeCriacao($base_query) {
        $idUsuarioAdminSetorQualidade = Configuracao::where('id', '=', 2)->first();
        $documentosEmCriacao          = array();
        
        $baseQueryLocal = clone $base_query;
        $baseQueryLocal->where('dados_documento.finalizado', '=', false)
                        ->where('dados_documento.revisao', '=', '00')
                        ->where('dados_documento.em_revisao', '=', false);

        $cloneBaseQueryEtapa1Elaborador       = clone $baseQueryLocal;
        $cloneBaseQueryEtapa2Qualidade        = clone $baseQueryLocal;
        $cloneBaseQueryEtapa3AreaDeInteresse  = clone $baseQueryLocal;
        $cloneBaseQueryEtapa4Aprovadores      = clone $baseQueryLocal;
        $cloneBaseQueryEtapas5e6Elaborador    = clone $baseQueryLocal; // Etapa 1 "não existe" em processo de criação [EXISTE SIM HEUHEUHE]
        $cloneBaseQueryEtapa7CapitalHumano    = clone $baseQueryLocal;
        $cloneBaseQueryTodasEtapasMaioresQue2 = clone $baseQueryLocal;

        // Conforme regras do sistema, se o usuário for do Setor Qualidade, ele poderá ver os documentos em todas as etapas        
        if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE ) {
            
            // Detalhe específico para documentos confidenciais: apenas o administrador do Setor Qualidade pode vê-los.
            if( Auth::user()->id == $idUsuarioAdminSetorQualidade->admin_setor_qualidade )  {
                $etapa2 = $cloneBaseQueryEtapa2Qualidade->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM)->get();

                $etapa1 = $cloneBaseQueryEtapa1Elaborador->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM)->get();

                $todasEtapasMaioresQue2 = $cloneBaseQueryTodasEtapasMaioresQue2->where('workflow.etapa_num', '>', Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM)->get();
            } else {
                $etapa2 = $cloneBaseQueryEtapa2Qualidade->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM)
                                                        ->where('dados_documento.nivel_acesso', '!=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)->get();

                $etapa1 = $cloneBaseQueryEtapa1Elaborador->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM)
                                                         ->where('dados_documento.nivel_acesso', '!=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)->get();

                $todasEtapasMaioresQue2 = $cloneBaseQueryTodasEtapasMaioresQue2->where('workflow.etapa_num', '>', Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM)
                                                                                ->where('dados_documento.nivel_acesso', '!=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)->get();
            }            

            $documentosEmCriacao[] = $etapa2->values()->all();
            $documentosEmCriacao[] = $etapa1->values()->all();
            $documentosEmCriacao[] = $todasEtapasMaioresQue2->values()->all();
        } else {
            // Documentos em Criação - Etapa 1
            $etapa1 = $cloneBaseQueryEtapa1Elaborador->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM)
                                                      ->where('elaborador_id', '=', Auth::user()->id)->get();

            if( $etapa1->count() > 0 ) $documentosEmCriacao[] = $etapa1->values()->all();


            // Documentos em Criação - Etapa 3
            $etapa3 = $cloneBaseQueryEtapa3AreaDeInteresse->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_AREA_DE_INTERESSE_NUM)->get();

            $aux_etapa3 = clone $etapa3;
            foreach ($aux_etapa3 as $key => $value) {
                $usuariosDaAreaDeInteresseDoDocumento = AreaInteresseDocumento::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();
                if( !in_array(Auth::user()->id, $usuariosDaAreaDeInteresseDoDocumento) ) $etapa3->forget($key);
            }
            $documentosEmCriacao[] = $etapa3->values()->all();

            // Documentos em Criação - Etapa 4
            $etapa4 = $cloneBaseQueryEtapa4Aprovadores->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_APROVADOR_NUM)->get();

            $aux_etapa4 = clone $etapa4;
            foreach ($aux_etapa4 as $key => $value) {              
                $aprovadoresSetorDonoDocumento = User::select('users.id', 'users.name')
                                                        ->join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                        ->where('aprovador_setor.setor_id', '=', $value->setor_id)
                                                        ->get()
                                                        ->pluck('name', 'id')
                                                        ->toArray();

                if( !in_array(Auth::user()->id, array_keys($aprovadoresSetorDonoDocumento)) ) $etapa4->forget($key);
            }
            $documentosEmCriacao[] = $etapa4->values()->all();

            // Documentos em Criação - Etapas 5 e 6
            $etapa5e6 = $cloneBaseQueryEtapas5e6Elaborador->whereIn('workflow.etapa_num', array(Constants::$ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_NUM, Constants::$ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_NUM))
                                                          ->where('elaborador_id', '=', Auth::user()->id)->get();

            if( $etapa5e6->count() > 0 ) $documentosEmCriacao[] = $etapa5e6->values()->all();

            // Documentos em Criação - Etapa 7
            if( Auth::user()->setor_id == Constants::$ID_SETOR_CAPITAL_HUMANO ) {
                $etapa7 = $cloneBaseQueryEtapa7CapitalHumano->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM)->get();

                $documentosEmCriacao[] = $etapa7->values()->all();
            }
        }
        
        // Passa todos os documentos, de cada etapa, para a raiz de um novo array, de forma que tods fiquem no mesmo nível hierrárquico
        $returnDocumentosEmCriacao = array();
        foreach ($documentosEmCriacao as $key => $value) {
            if (is_array($value)) {
              $returnDocumentosEmCriacao = array_merge($returnDocumentosEmCriacao, $value);
            }
        }
        
        return $returnDocumentosEmCriacao;    
    }


    private function getDocumentosEmProcessoDeRevisao($base_query) {
        $idUsuarioAdminSetorQualidade = Configuracao::where('id', '=', 2)->get();
        $ID_USUARIO                   = Auth::user()->id;
        $ID_SETOR_USUARIO             = Auth::user()->setor_id;
        $documentosEmRevisao          = array();
        
        $baseQueryLocal = clone $base_query;
        $baseQueryLocal->where('dados_documento.finalizado', '=', false)
                        ->where('dados_documento.revisao', '!=', '00')
                        ->where('dados_documento.em_revisao', '=', true);

        $cloneBaseQueryDocsLivres         = clone $baseQueryLocal;
        $cloneBaseQueryDocsRestritos      = clone $baseQueryLocal;
        $cloneBaseQueryDocsConfidenciais  = clone $baseQueryLocal;

        $docsFinalizadosLivres        = $cloneBaseQueryDocsLivres->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_LIVRE)->get();
        $docsFinalizadosRestritos     = $cloneBaseQueryDocsRestritos->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_RESTRITO)->get();
        $docsFinalizadosConfidenciais = $cloneBaseQueryDocsConfidenciais->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)->get();


        // Se for do Setor Qualidade, seguindo as regras atuais, todos os documentos restritos devem ser listados
        if( $ID_SETOR_USUARIO != Constants::$ID_SETOR_QUALIDADE ) {
            $aux_docsFinalizadosRestritos = clone $docsFinalizadosRestritos;
            foreach ($aux_docsFinalizadosRestritos as $key => $value) {
                $usuariosDaAreaDeInteresseDoDocumento = AreaInteresseDocumento::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $usuariosExtraDoDocumento             = UsuarioExtra::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $aprovadoresDoSetorDonoDoDocumento    = User::select('users.id', 'users.name')->join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                                ->where('aprovador_setor.setor_id', '=', $value->setor_id)
                                                                ->get()->pluck('name', 'id')->toArray();

                /* Segundo regras do sistema, o documento será listado para: 
                    Elaborador; ou Todos os membros do setor Qualidade (automaticamente, em virtude de não entrar neste if); 
                        ou para todos os membros da Area de Interesse; ou para todos usuários do grupo de aprovadores do setor dono do documento;
                        ou para todos os membros do setor dono do documento; ou para todos os usuários extras definidos por algum usuário do setor Qualidade.
                */
                if( $ID_USUARIO == $value->elaborador_id  ||   in_array($ID_USUARIO, $usuariosDaAreaDeInteresseDoDocumento)  ||  
                    in_array($ID_USUARIO, array_keys($aprovadoresDoSetorDonoDoDocumento))  ||  $ID_SETOR_USUARIO == $value->setor_id  ||  
                    in_array($ID_USUARIO, $usuariosExtraDoDocumento) ) {
                    continue;
                } else {
                    $docsFinalizadosRestritos->forget($key);
                }
            }

        }

        // Se for o Administrador do Setor Qualidade, seguindo as regras atuais, todos os documentos confidenciais devem ser listados
        if(Auth::user()->id != $idUsuarioAdminSetorQualidade[0]->admin_setor_qualidade) {
            $aux_docsFinalizadosConfidenciais = clone $docsFinalizadosConfidenciais;
            foreach ($aux_docsFinalizadosConfidenciais as $key => $value) {
                $usuariosDaAreaDeInteresseDoDocumento = AreaInteresseDocumento::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $usuariosExtraDoDocumento             = UsuarioExtra::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $aprovadoresDoSetorDonoDoDocumento    = User::select('users.id', 'users.name')->join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                                ->where('aprovador_setor.setor_id', '=', $value->setor_id)
                                                                ->get()->pluck('name', 'id')->toArray();

                // Lista para o elaborador, para o usuário ADMIN da Qualidade, para todos os membros da área de interesse e para o grupo de aprovadores  + e para todos os usuários extras que alguém da qualidade definir
                /* Segundo regras do sistema, o documento será listado para: 
                    Elaborador; ou para o administrador do setor Qualidade (automaticamente, em virtude de não entrar neste if); 
                        ou para todos os membros da Area de Interesse; ou para todos usuários do grupo de aprovadores do setor dono do documento;
                        ou para todos os usuários extras definidos por algum usuário do setor Qualidade.
                */
                if( $ID_USUARIO == $value->elaborador_id  ||  in_array($ID_USUARIO, $usuariosDaAreaDeInteresseDoDocumento)  ||  
                    in_array($ID_USUARIO, array_keys($aprovadoresDoSetorDonoDoDocumento)) ||  in_array($ID_USUARIO, $usuariosExtraDoDocumento) ) {
                    continue;
                } else {
                    $docsFinalizadosConfidenciais->forget($key);
                }
            }
        }

        $documentosEmRevisao[] = $docsFinalizadosLivres->values()->all();
        $documentosEmRevisao[] = $docsFinalizadosRestritos->values()->all();
        $documentosEmRevisao[] = $docsFinalizadosConfidenciais->values()->all();
        
        // Passa todos os documentos, de cada nível de acesso, para a raiz de um novo array, de forma que tods fiquem no mesmo nível hierrárquico
        $returnDocumentosEmRevisao = array();
        foreach ($documentosEmRevisao as $key => $value) {
            if (is_array($value)) {
                $returnDocumentosEmRevisao = array_merge($returnDocumentosEmRevisao, $value);
            }
        }

        // Loop que irá definir quais documentos devem ser mostrados com sua última revisão vigente e quais devem ser mostrados com a respectiva etapa da revisão.
        foreach ($returnDocumentosEmRevisao as $key => $value) {
            // Se o usuário for do Setor Qualidade, a etapa permanecerá exatamente a mesma que veio do B.D., ou seja, não será mostrada a última revisão vigente finalizada e sim a revisão que está, atualmente, sendo alterada.
            if( $ID_SETOR_USUARIO != Constants::$ID_SETOR_QUALIDADE  ||  ($value->nivel_acesso == Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL  &&  $ID_USUARIO != $idUsuarioAdminSetorQualidade[0]->admin_setor_qualidade) )  {
                $statusDoDocumentoParaListagem = $this->defineStatusDeListagemDoDocumento($value->id);
                $value->etapa                  = $statusDoDocumentoParaListagem;
                // Se retornar 'Finalizado' é porque este documento, que está em revisão, não necessita de uma ação direta deste usuário e, portanto, exibirá a última revisão vigente.
                if( $statusDoDocumentoParaListagem == "Finalizado" ) {
                    $numRevisaoAnterior = (int) $value->revisao - 1; 
                    $value->revisao = ($value->revisao <= 10) ? "0{$numRevisaoAnterior}" : $numRevisaoAnterior;
                }
            }
        }

        return $returnDocumentosEmRevisao;    
    }


    private function getDocumentosFinalizados($base_query) {
        $documentosFinalizados        = array(); 
        $idUsuarioAdminSetorQualidade = Configuracao::where('id', '=', 2)->get();

        $cloneBaseQueryDocumentosLivres         = clone $base_query;
        $cloneBaseQueryDocumentosRestritos      = clone $base_query;
        $cloneBaseQueryDocumentosConfidenciais  = clone $base_query;

        /* 
        *    Início das validações de quais documentos devem ser retornados para que sejam listados para o usuário
        */
        $docsFinalizados_livres = $cloneBaseQueryDocumentosLivres->where('dados_documento.finalizado', '=', true)
                                                    ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_LIVRE)
                                                    ->get();

        // Sorry about that, @zyadkhalil
        $docsFinalizados_restritos = array();
        if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) {
        $docsFinalizados_restritos = $cloneBaseQueryDocumentosRestritos->where('dados_documento.finalizado', '=', true)
                        ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_RESTRITO)
                        ->get();
        } else {
            $I_U = Auth::user()->id;
            $SI_U = Auth::user()->setor_id;
            $docsFinalizados_restritos = $cloneBaseQueryDocumentosRestritos->where('dados_documento.finalizado', '=', true)
                                                            ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_RESTRITO)
                                                            ->get();

            $aux_docsFinalizados_restritos = clone $docsFinalizados_restritos;
            foreach ($aux_docsFinalizados_restritos as $key => $value) {
                $usuariosDaAreaDeInteresseDoDocumento = AreaInteresseDocumento::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $usuariosExtraDoDocumento = UsuarioExtra::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $usuariosAprovadoresDoSetorDonoDoDocumento = User::select('users.id', 'users.name')
                                                                    ->join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                                    ->where('aprovador_setor.setor_id', '=', $value->setor_id)
                                                                    ->get()->pluck('name', 'id')->toArray();

                // lista para todos os envolvidos na criação do doc (elaborador, qualidade, área de interesse e grupo de aprovadores) e para todos os membros do setor dono do documento  + e para todos os usuários extras que alguém da qualidade definir
                if( $value->elaborador_id == $I_U  ||  $SI_U == Constants::$ID_SETOR_QUALIDADE  ||  in_array($I_U, $usuariosDaAreaDeInteresseDoDocumento)  ||  in_array($I_U, $usuariosExtraDoDocumento)  ||  in_array($I_U, array_keys($usuariosAprovadoresDoSetorDonoDoDocumento))  ||  $SI_U == $value->setor_id ) {
                    continue;
                } else {
                    $docsFinalizados_restritos->forget($key);
                }
            }

        }

        $docsFinalizados_confidenciais = array();
        if(Auth::user()->id == $idUsuarioAdminSetorQualidade[0]->admin_setor_qualidade) {
            $docsFinalizados_confidenciais = $cloneBaseQueryDocumentosConfidenciais->where('dados_documento.finalizado', '=', true)
                                                                                        ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                                                        ->get();
        } else {
            $I_U = Auth::user()->id;
            $SI_U = Auth::user()->setor_id;
            $docsFinalizados_confidenciais = $cloneBaseQueryDocumentosConfidenciais->where('dados_documento.finalizado', '=', true)
                                                                                        ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                                                        ->get();

            $aux_docsFinalizados_confidenciais = clone $docsFinalizados_confidenciais;
            foreach ($aux_docsFinalizados_confidenciais as $key => $value) {
                $usuariosDaAreaDeInteresseDoDocumento = AreaInteresseDocumento::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $usuariosExtraDoDocumento = UsuarioExtra::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();

                $usuariosAprovadoresDoSetorDonoDoDocumento = User::select('users.id', 'users.name')
                                                                    ->join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
                                                                    ->where('aprovador_setor.setor_id', '=', $value->setor_id)
                                                                    ->get()
                                                                    ->pluck('name', 'id')
                                                                    ->toArray();

                // Lista para o elaborador, para o usuário ADMIN da Qualidade, para todos os membros da área de interesse e para o grupo de aprovadores  + e para todos os usuários extras que alguém da qualidade definir
                if( $value->elaborador_id == $I_U  ||  $I_U == $idUsuarioAdminSetorQualidade[0]->admin_setor_qualidade  ||  in_array($I_U, $usuariosDaAreaDeInteresseDoDocumento)  ||  in_array($I_U, $usuariosExtraDoDocumento) ||  in_array($I_U, array_keys($usuariosAprovadoresDoSetorDonoDoDocumento)) ) {
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

        if( $docsFinalizados_confidenciais->count() > 0 && count($docsFinalizados_confidenciais) > 0 )     
            foreach($docsFinalizados_confidenciais as $key => $value)
                $documentosFinalizados[] = $value; 

        
        
        return $documentosFinalizados;
    }

    




































    protected function getNotFinishedDocuments($base_query) {
        $documentos_NAOFinalizados      = array();
        $idUsuarioAdminSetorQualidade   = Configuracao::where('id', '=', 2)->get();

        $cloneBaseQueryDocumentosNAOConfidenciais   = clone $base_query;
        $cloneBaseQueryDocumentosConfidenciais      = clone $base_query;
        $cloneBaseQueryEtapa1Elaborador             = clone $base_query;
        $cloneBaseQueryEtapa4Aprovadores            = clone $base_query;
        $cloneBaseQueryEtapas5e6UploadListaPresenca = clone $base_query;
        $cloneBaseQueryEtapa7CapitalHumano          = clone $base_query;
        $cloneBaseQueryEtapa3AreaInteresse          = clone $base_query;


        /* 
        *    Início das validações de quais documentos devem ser retornados para que sejam listados para o usuário
        */
        if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) {
            $documentos_NAOFinalizados_NAOConfidenciais;
            $documentos_NAOFinalizados_Confidenciais = array();
            
            $documentos_NAOFinalizados_NAOConfidenciais = $cloneBaseQueryDocumentosNAOConfidenciais->where('dados_documento.finalizado', '=', false)
                                                                                                    ->where('dados_documento.nivel_acesso', '!=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                                                                    ->get();

                                                                        
            if(Auth::user()->id == $idUsuarioAdminSetorQualidade[0]->admin_setor_qualidade) {
                $documentos_NAOFinalizados_Confidenciais = $cloneBaseQueryDocumentosConfidenciais->where('dados_documento.finalizado', '=', false)
                                                                                                    ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                                                                    ->get();                                                        
            }

            if( count($documentos_NAOFinalizados_NAOConfidenciais) > 0 ) 
                for ($i=0; $i < count($documentos_NAOFinalizados_NAOConfidenciais); $i++) 
                    $documentos_NAOFinalizados[] = $documentos_NAOFinalizados_NAOConfidenciais[$i]; 


            if( count($documentos_NAOFinalizados_Confidenciais) > 0 ) 
                for ($i=0; $i < count($documentos_NAOFinalizados_Confidenciais); $i++) 
                    $documentos_NAOFinalizados[] = $documentos_NAOFinalizados_Confidenciais[$i]; 

        } else if( Auth::user()->setor_id != Constants::$ID_SETOR_QUALIDADE ) { //  && Auth::user()->setor_id != Constants::$ID_SETOR_CAPITAL_HUMANO

            $docs_etapa1 = $cloneBaseQueryEtapa1Elaborador->where('dados_documento.finalizado', '=', false)
                                                            ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM)
                                                            ->where('dados_documento.elaborador_id', '=', Auth::user()->id)
                                                            ->get();
            
            // Documentos na etapa 3 PRECISAM, OBRIGATORIAMENTE, possuir uma Área de Interesse para si (VER SLACK)
            $docs_etapa3 = $cloneBaseQueryEtapa3AreaInteresse->where('dados_documento.finalizado', '=', false)
                                                                ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_AREA_DE_INTERESSE_NUM)
                                                                ->get();

            $aux_etapa3 = clone $docs_etapa3;
            foreach ($aux_etapa3 as $key => $value) {
                $usuariosDaAreaDeInteresseDoDocumento = AreaInteresseDocumento::where('documento_id', '=', $value->id)->get()->pluck('usuario_id')->toArray();
                
                if( !in_array(Auth::user()->id, $usuariosDaAreaDeInteresseDoDocumento) ) $docs_etapa3->forget($key);
            }


            $docs_etapa4 = $cloneBaseQueryEtapa4Aprovadores->where('dados_documento.finalizado', '=', false)
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



            $docs_etapas_5_6 = $cloneBaseQueryEtapas5e6UploadListaPresenca->where('dados_documento.finalizado', '=', false)
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

            if( $docs_etapa4->count() > 0 && count($docs_etapa4) > 0 ) 
                foreach($docs_etapa4 as $key => $value)
                    $documentos_NAOFinalizados[] = $value; 

            if( count($docs_etapas_5_6) > 0 ) 
                for ($i=0; $i < count($docs_etapas_5_6); $i++) 
                    $documentos_NAOFinalizados[] = $docs_etapas_5_6[$i]; 

         
            // Além de tudo isso, se for um usuário do Capital Humano, precisa listar os docs na etapa 7
            if(Auth::user()->setor_id == Constants::$ID_SETOR_CAPITAL_HUMANO) {
                $docs_etapa7 = $cloneBaseQueryEtapa7CapitalHumano->where('dados_documento.finalizado', '=', false)
                                                                    ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM)
                                                                    ->get();
    
                if( count($docs_etapa7) > 0 ) 
                    for ($i=0; $i < count($docs_etapa7); $i++) 
                        $documentos_NAOFinalizados[] = $docs_etapa7[$i];  
            }
        }

        
        return $documentos_NAOFinalizados;
    }
    

}
