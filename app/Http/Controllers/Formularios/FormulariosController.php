<?php

namespace App\Http\Controllers\Formularios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DadosNovoFormularioRequest;
use App\GrupoDivulgacao;
use App\Setor;
use App\Documento;
use App\Formulario;
use App\DocumentoFormulario;
use App\FormularioRevisao;
use App\HistoricoFormulario;
use App\NotificacaoFormulario;
use App\TipoDocumento;
use Illuminate\Support\Facades\View;
use App\Configuracao;
use App\User;
use S3Presigned;
use App\WorkflowFormulario;
use App\Classes\Constants;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailsJob;

class FormulariosController extends Controller
{
    
    public function index() {
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $documentos        = Documento::join('tipo_documento','tipo_documento.id','=', 'documento.tipo_documento_id')->get(['documento.id as doc_id', 'nome', 'nome_tipo', 'sigla'])->groupBy('nome_tipo')->toArray();
        $formularios       = $this->getFormsIndex();
        
        // $formularios1_old  = Formulario::join('workflow_formulario', 'workflow_formulario.formulario_id', '=', 'formulario.id')->get();      

        return view('formularios.index', ['formularios'=>$formularios, 'grupoDivulgacao' => $gruposDivulgacao, 'setores'=>$setores, 'documentosTipo'=>$documentos]);
    }

    public function filterFormsIndex(Request $request){
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $documentos        = Documento::join('tipo_documento','tipo_documento.id','=', 'documento.tipo_documento_id')->get(['documento.id as doc_id', 'nome', 'nome_tipo', 'sigla'])->groupBy('nome_tipo')->toArray();
        
        $formularios       = $this->filterListForms($request->all());

        return view('formularios.index', ['formularios'=>$formularios, 'grupoDivulgacao' => $gruposDivulgacao, 'setores'=>$setores, 'documentosTipo'=>$documentos]);
    }
    
    public function validateData(DadosNovoFormularioRequest $request) {

        $text_setorDono       = Setor::where('id', '=', $request->setor_dono_form)->get(['nome', 'sigla']);
        $text_grupoDivulgacao = GrupoDivulgacao::where('id', '=', $request->grupoDivulgacao)->get(['nome']);
        $acao = $request->action;

        $nivelAcessoDocumento = (  ($request->nivelAcessoDocumento == 0) ? Constants::$NIVEL_ACESSO_DOC_LIVRE : ( ($request->nivelAcessoDocumento == 1) ? Constants::$NIVEL_ACESSO_DOC_RESTRITO : Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL  )    );

        $qtdForms = Formulario::count();

        $tipoDocumento = TipoDocumento::where('id', '=', Constants::$ID_TIPO_DOCUMENTO_FORMULARIO)->get(['nome_tipo', 'sigla']);
    
        $codigo_final = $tipoDocumento[0]->sigla."-";
        $codigo = 0;

        if( count($qtdForms) <= 0 )  {
            $codigo = $this->buildCodDocument(1);
        } else { 
            $codigo = $this->buildCodDocument($qtdForms + 1);
        }
        
        // Concatena e gera o código final
        $codigo_final .= $text_setorDono[0]->sigla. "-".$codigo;

        return view('formularios.define-formulario', [
            'acao'=>$acao,
            'codigoFormulario' => $codigo_final,
            'tituloFormulario' => $request->tituloFormulario,
            'grupoDivulgacao' => $request->grupoDivulgacao,
            'nivelAcessoDocumento' => $nivelAcessoDocumento,
            'text_grupoDivulgacao' => $text_grupoDivulgacao[0]->nome,
            'setorDono' => $request->setor_dono_form,
            'text_setorDono' => $text_setorDono[0]->nome
        ]);

    }

    public function viewForm(Request $request){ 
        if( array_key_exists("notify_id", $request->all()) ) {
            \App\Classes\Helpers::instance()->atualizaNotificacaoFormVisualizada($request->notify_id);
        }       
    
        $formulario   = Formulario::where('id', '=', $request->formulario_id)->get();    
        $workflowForm = WorkflowFormulario::where('formulario_id', '=', $request->formulario_id)->get();
        $historico    = HistoricoFormulario::join('formulario', 'formulario.id', '=', 'historico_formulario.formulario_id')
                                            ->join('users', 'users.id', '=', 'formulario.elaborador_id')
                                            ->where('formulario_id', '=', $request->formulario_id)
                                            ->orderby('finalizado')->get();

        $filePath = ($formulario[0]->em_revisao && Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) ? $formulario[0]->nome_completo_em_revisao : $formulario[0]->nome.".".$formulario[0]->extensao;

        return View::make('formularios.view-formulario', array(
            'nome'=>$formulario[0]->nome,  
            'acao'=>$request->action,  
            'formulario_id'=>$request->formulario_id, 
            'historico'=>$historico, 
            'codigo'=>$formulario[0]->codigo, 
            'extensao'=>$formulario[0]->extensao,
            'filePath'=> $filePath, 
            'formData'=>trim($formulario[0]->conteudo, '"'), 
            'etapa_form'=>$workflowForm[0]->etapa_num,
            'elaborador_id'=>$formulario[0]->elaborador_id,
            'finalizado'=>$formulario[0]->finalizado,
            'em_revisao'=>$formulario[0]->em_revisao,
            'justificativaRejeicaoForm'=>$workflowForm[0]->justificativa,
            'id_usuario_solicitante'=>$formulario[0]->id_usuario_solicitante,
            'justificativa_cancelar_revisao'=>$formulario[0]->justificativa_cancelar_revisao,
            'resp'=>false)
        );
    }

    public function saveAttachedDocument(Request $request) { // USAR QUANDO TIVER TEMPO: UploadDocumentRequest  
        $file = $request->file('doc_uploaded', 'local');
        $extensao = $file->getClientOriginalExtension();
        $titulo   = $request->tituloFormulario;
        $codigo   = $request->codigoFormulario;
        $filename =  \App\Classes\Helpers::instance()->escapeFilename($titulo);
        \Storage::disk('speed_office')->put('/formularios/'.$filename .".". $extensao, file_get_contents($file), 'private');

        $formulario = new Formulario();
        $formulario->nome                           = $filename;
        $formulario->codigo                         = $request->codigoFormulario;
        $formulario->extensao                       = $extensao;
        $formulario->setor_id                       = $request->setor_dono_form;
        $formulario->grupo_divulgacao_id            = $request->grupoDivulgacao;
        $formulario->nivel_acesso                   = $request->nivel_acesso;
        $formulario->finalizado                     = false;
        $formulario->elaborador_id                  = Auth::user()->id;
        $formulario->tipo_documento_id              = Constants::$ID_TIPO_DOCUMENTO_FORMULARIO;
        $formulario->revisao                        = "00";
        $formulario->em_revisao                     = false;
        $formulario->id_usuario_solicitante         = null;
        $formulario->nome_completo_finalizado       = null;
        $formulario->nome_completo_em_revisao       = null;
        $formulario->justificativa_cancelar_revisao = null;
        $formulario->save();

        // Quando tiver tempo, verificar se deu certo a inserção dos dados do documento
        $workflow = new WorkflowFormulario();
        $workflow->etapa_num    = Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
        $workflow->etapa        = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
        $workflow->descricao    = "";
        $workflow->justificativa= "";
        $workflow->formulario_id = $formulario->id; // id que acabou de ser inserido no 'save' na tabela de formulário
        $workflow->save();
        
        
        // Gravar notificação para todos usuários do setor Qualidade sobre a criação do documento
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        foreach ($usuariosSetorQualidade as $key => $user) {
            \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $codigo . " foi emitido e necessita ser revisado.", true, $user->id, $formulario->id);
        }

        // [E-mail -> (10)]
        $setor = Setor::where('id', '=', $formulario->setor_id)->select('nome')->get();
        $elaborador = User::where('id', '=', $formulario->elaborador_id)->select('name')->get();

        $icon = "info";
        $contentF1_P1 = "O formulário "; $codeF1 = $formulario->codigo; $contentF1_P2 = " requer análise.";
        $labelF2 = "Setor do formulário: "; $valueF2 = $setor[0]->nome;
        $labelF3 = "Enviado por: "; $valueF3 = $elaborador[0]->name; $label2_F3 = ""; $value2_F3 = "";
        // $this->dispatch(new SendEmailsJob($usuariosSetorQualidade, "Novo formulário para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));
        
        // Grava histórico do documento
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_EMISSAO, $formulario->id);
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE, $formulario->id);

        return View::make('formularios.define-formulario', array('overlay_sucesso' => 'valor'));
    }

    public function startReview(Request $request) {
        $alterarElaborador = false;
        $nomeAntigoElaborador = "";
        
        $formulario = Formulario::where('id', '=', $request->form_id)->get();
        
        if($formulario[0]->elaborador_id != Auth::user()->id) {
            $alterarElaborador = true;
            $nomeAntigoElaborador = User::where('id', '=', $formulario[0]->elaborador_id)->get()[0]->name;
        }
        
        if($alterarElaborador) $formulario[0]->elaborador_id = Auth::user()->id;
        $formulario[0]->finalizado = false;
        $formulario[0]->em_revisao = true;
        $formulario[0]->id_usuario_solicitante = Auth::user()->id;
        $formulario[0]->nome_completo_em_revisao = $formulario[0]->nome .".". $formulario[0]->extensao;
        $formulario[0]->save();

        $workflowForm                = WorkflowFormulario::where('formulario_id', '=', $request->form_id)->get();
        $workflowForm[0]->etapa_num  = Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM;
        $workflowForm[0]->etapa      = Constants::$DESCRICAO_WORKFLOW_EM_REVISAO;
        $workflowForm[0]->save();

        // Gravar notificação para todos usuários do setor Qualidade sobre a criação do documento
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        foreach ($usuariosSetorQualidade as $key => $user) {
            \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("Foi iniciado um processo de revisão no formulário " . $formulario[0]->codigo . ".", false, $user->id, $formulario[0]->id);
        }

        \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " teve sua revisão iniciada.", true, $formulario[0]->elaborador_id, $formulario[0]->id);

        // Grava histórico do documento
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_FORM_REVISAO_INICIADA, $formulario[0]->id);
        if($alterarElaborador) \App\Classes\Helpers::instance()->gravaHistoricoFormulario("Elaborador alterado de ". $nomeAntigoElaborador ." para ". Auth::user()->name .".", $formulario[0]->id);
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_EM_REVISAO, $formulario[0]->id);

        return redirect()->route('formularios')->with('start_review_success', 'msg');
    }

    public function sendNewReview(Request $request) {
        $idForm     = $request->formulario_id;
        $file       = $request->file('new_review_form', 'local');
        $extensao   = $file->getClientOriginalExtension();
        $formulario     = Formulario::where('id', '=', $idForm)->get();
        $workflowForm   = WorkflowFormulario::where('formulario_id', '=', $idForm)->get();

        $revisaoNova = (int) $formulario[0]->revisao + 1;
        $revisaoNova = ($revisaoNova <= 9) ? "0{$revisaoNova}" : $revisaoNova;
        $filename = ($request->newTituloFormulario == $formulario[0]->nome) ? $request->newTituloFormulario . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . $revisaoNova : $request->newTituloFormulario;
        $fullFilename = $filename .".". $extensao;

        // Salva nova revisão do formulário (mantém o arquivo origianl e cria uma nova "versão", semelhante à CÓPIA feita nos documentos)
        \Storage::disk('speed_office')->put('/formularios/' . $fullFilename, file_get_contents($file), 'private');
        
        $formulario[0]->nome_completo_em_revisao = $fullFilename;
        $formulario[0]->nome                     = $filename;
        $formulario[0]->extensao                 = $extensao;
        $formulario[0]->codigo                   = $request->newCodigoFormulario;
        $formulario[0]->save();

        $workflowForm[0]->etapa_num    = Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
        $workflowForm[0]->etapa        = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
        $workflowForm[0]->save();

        // Notificações
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        foreach ($usuariosSetorQualidade as $key => $user) {
            \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " precisa ser analisado.", true, $user->id, $idForm);
        }

        // [E-mail -> (10)]
        $setor = Setor::where('id', '=', $formulario[0]->setor_id)->select('nome')->get();
        $elaborador = User::where('id', '=', $formulario[0]->elaborador_id)->select('name')->get();

        $icon = "info";
        $contentF1_P1 = "O formulário "; $codeF1 = $formulario[0]->codigo; $contentF1_P2 = " requer análise.";
        $labelF2 = "Setor do formulário: "; $valueF2 = $setor[0]->nome;
        $labelF3 = "Enviado por: "; $valueF3 = $elaborador[0]->name; $label2_F3 = ""; $value2_F3 = "";
        $this->dispatch(new SendEmailsJob($usuariosSetorQualidade, "Novo formulário para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_REENVIADO_COLABORADOR, $idForm);
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE, $idForm);

        return redirect()->route('formularios')->with('send_new_review_success', 'msg');
    }

    public function cancelReview(Request $request) {
        $idForm = $request->formulario_id;
        $formulario = Formulario::where('id', '=', $idForm)->get();
        $revisaoAnteriorFormulario = FormularioRevisao::where('formulario_id', '=', $idForm)->where('revisao', '=', $formulario[0]->revisao)->get(); // Se não enviar o parâmetro da revisão atual, ele vai pegar o primeiro registor e restaurar a 1º versão do formulário, mesmo que exista mais que uma revisão

        // Notificações
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        foreach ($usuariosSetorQualidade as $key => $user) {
            if($user->id != $formulario[0]->elaborador_id) \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " teve a revisão cancelada pela Qualidade.", false, $user->id, $idForm);
        }
        
        \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " teve a revisão cancelada pela Qualidade.", true, $formulario[0]->elaborador_id, $idForm);

        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_REVISAO_FORM_CANCELADA_FULL, $idForm);
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_RETORNA_REVISAO_ANTERIOR_FORM_FULL, $idForm);
        
        // Excluindo arquivo anexado durante a revisão
        \Storage::disk('speed_office')->delete('formularios/' . $formulario[0]->nome_completo_em_revisao);

        // Restaurando versão anterior do form
        $formulario[0]->nome                            = $revisaoAnteriorFormulario[0]->nome;
        $formulario[0]->codigo                          = $revisaoAnteriorFormulario[0]->codigo;
        $formulario[0]->extensao                        = $revisaoAnteriorFormulario[0]->extensao;
        $formulario[0]->nivel_acesso                    = $revisaoAnteriorFormulario[0]->nivel_acesso;
        $formulario[0]->finalizado                      = true;
        $formulario[0]->tipo_documento_id               = $revisaoAnteriorFormulario[0]->tipo_documento_id;
        $formulario[0]->elaborador_id                   = $revisaoAnteriorFormulario[0]->elaborador_id;
        $formulario[0]->setor_id                        = $revisaoAnteriorFormulario[0]->setor_id;
        $formulario[0]->grupo_divulgacao_id             = $revisaoAnteriorFormulario[0]->grupo_divulgacao_id;
        $formulario[0]->em_revisao                      = false;
        $formulario[0]->nome_completo_finalizado        = null;
        $formulario[0]->nome_completo_em_revisao        = null;
        $formulario[0]->justificativa_cancelar_revisao  = $request->justificativaCancelamentoRevisaoForm;
        $formulario[0]->save();

        return redirect()->route('formularios')->with('cancel_review_success', 'msg');
    }

    public function makeObsoleteForm(Request $request) {
        $formulario = Formulario::where('id', '=', $request->form_id)->first();
        $formulario->obsoleto = true;
        $formulario->save();

        $vinculoComDocumentos = DocumentoFormulario::where('formulario_id', '=', $request->form_id)->get();
        foreach ($vinculoComDocumentos as $key => $value) {
            $value->delete();
        }

        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_FORM_MARCADO_COMO_OBSOLETO, $request->form_id);

        return redirect()->route('formularios')->with('make_obsolete_form', 'msg');
    }

    public function makeActiveForm(Request $request) {
        $formulario = Formulario::where('id', '=', $request->form_id)->first();
        $formulario->obsoleto = false;
        $formulario->save();

        return redirect()->route('formularios')->with('make_active_form', 'msg');
    }

    public function viewObsoleteForm(Request $request) {
        $formulario   = Formulario::where('id', '=', $request->formulario_id)->get();    
        $workflowForm = WorkflowFormulario::where('formulario_id', '=', $request->formulario_id)->get();
        $historico    = HistoricoFormulario::join('formulario', 'formulario.id', '=', 'historico_formulario.formulario_id')
                                            ->join('users', 'users.id', '=', 'formulario.elaborador_id')
                                            ->where('formulario_id', '=', $request->formulario_id)
                                            ->orderby('finalizado')->get();

        $filePath = ($formulario[0]->em_revisao && Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) ? $formulario[0]->nome_completo_em_revisao : $formulario[0]->nome.".".$formulario[0]->extensao;

        return View::make('formularios.view-obsolete-form', array(
            'nome'=>$formulario[0]->nome,  
            'acao'=>$request->action,  
            'formulario_id'=>$request->formulario_id, 
            'historico'=>$historico, 
            'codigo'=>$formulario[0]->codigo, 
            'extensao'=>$formulario[0]->extensao,
            'filePath'=> \App\Classes\Helpers::instance()->getFormulariosAWS($filePath), 
            'formData'=>trim($formulario[0]->conteudo, '"'), 
            'etapa_form'=>$workflowForm[0]->etapa_num,
            'elaborador_id'=>$formulario[0]->elaborador_id,
            'finalizado'=>$formulario[0]->finalizado,
            'em_revisao'=>$formulario[0]->em_revisao,
            'justificativaRejeicaoForm'=>$workflowForm[0]->justificativa,
            'id_usuario_solicitante'=>$formulario[0]->id_usuario_solicitante,
            'justificativa_cancelar_revisao'=>$formulario[0]->justificativa_cancelar_revisao,
            'resp'=>false)
        );
    }

    /*
    *       
    *  WORKFLOW FORMS
    *       
    */
    protected function approvalForm(Request $request) {
        $idForm = $request->formulario_id;

        $formulario = Formulario::where('id', '=', $idForm)->get();
        $workflow_form = WorkflowFormulario::where('formulario_id', '=', $idForm)->get();

        switch ($request->etapa_form) {
            case 1: // Elaborador
                

                break;

            case 2: // Qualidade
                $revisao = $formulario[0]->revisao;   
                $nome_completo_finalizado = $formulario[0]->nome .".". $formulario[0]->extensao; // Vai ser utilizado para situações como: revisão do formulário demora para ser aprovada e, enquanto isso, quem não está presente na etapa que a REVISÃO DO FORMULÁRIO está, tem que ver a última versão aprovada
                $newName = $formulario[0]->nome;
                $newExtension = $formulario[0]->extensao;

                // Uma revisão acabou de ser aprovada e não apenas um formulário que foi criado
                if( isset($request->aprovacao_revisao) && $request->aprovacao_revisao == "aprovar") {
                    $revisao = (int) $formulario[0]->revisao + 1;
                    $revisao = ($revisao <= 9) ? "0{$revisao}" : $revisao;

                    $nome_completo_finalizado = $formulario[0]->nome_completo_em_revisao;
                    
                    $arr = explode('.', $formulario[0]->nome_completo_em_revisao);
                    $sliced = array_slice($arr, 0, -1);
                    $newExtension = end( $arr );
                    $newName = implode("", $sliced);
                }

                // Popula tabela que irá armazenar um "histórico" das revisões (quase como um backup das 'versões')
                $formRevisao = new FormularioRevisao();
                $formRevisao->codigo                    = $formulario[0]->codigo;  
                $formRevisao->revisao                   = $revisao;   
                $formRevisao->nome                      = $formulario[0]->nome;
                $formRevisao->nome_completo             = $formulario[0]->nome .".". $formulario[0]->extensao;   
                $formRevisao->extensao                  = $formulario[0]->extensao;
                $formRevisao->nivel_acesso              = $formulario[0]->nivel_acesso;
                $formRevisao->finalizado                = true;
                
                $documentosNecessitam = DocumentoFormulario::where('formulario_id', '=', $formulario[0]->id)->get()->pluck('documento_id');
                $documentosNecessitam_TXT = null;
                foreach ($documentosNecessitam as $key => $value) {
                    if($documentosNecessitam_TXT == null) $documentosNecessitam_TXT = $value;
                    else $documentosNecessitam_TXT .= ";" . $value;
                }
                
                $formRevisao->documentos_necessitam     = $documentosNecessitam_TXT;             
                $formRevisao->formulario_id             = $formulario[0]->id;             
                $formRevisao->tipo_documento_id         = $formulario[0]->tipo_documento_id;             
                $formRevisao->elaborador_id             = $formulario[0]->elaborador_id;             
                $formRevisao->setor_id                  = $formulario[0]->setor_id;             
                $formRevisao->grupo_divulgacao_id       = $formulario[0]->grupo_divulgacao_id;             
                $formRevisao->save();             


                // Segue as trolladas do Zyad...
                $formulario[0]->nome = $newName;
                $formulario[0]->extensao = $newExtension;
                $formulario[0]->finalizado = true;
                $formulario[0]->revisao = $revisao;
                $formulario[0]->em_revisao = false;
                $formulario[0]->nome_completo_finalizado = $nome_completo_finalizado;
                $formulario[0]->save();

                $workflow_form[0]->etapa = Constants::$DESCRICAO_WORKFLOW_FORMULARIO_DIVULGADO;
                $workflow_form[0]->save();

                // Notificações
                // Qualidade
                $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->select('id', 'name', 'username', 'email', 'setor_id')->get();
                foreach ($usuariosSetorQualidade as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " foi revisado e aprovado pela Qualidade.", false, $user->id, $idForm);
                }
                
                //Grupo de Divulgação
                $usuariosGrupoDivulgacao = User::join('grupo_divulgacao_usuario', 'grupo_divulgacao_usuario.usuario_id', '=', 'users.id')
                                                    ->join('grupo_divulgacao', 'grupo_divulgacao.id', '=', 'grupo_divulgacao_usuario.grupo_id')
                                                    ->where('grupo_divulgacao.id', '=', $formulario[0]->grupo_divulgacao_id)
                                                    ->select('users.id', 'name', 'username', 'email', 'setor_id')->get();               
                foreach ($usuariosGrupoDivulgacao as $key => $userG) {
                    \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " foi revisado e aprovado pela Qualidade. (Início da Divulgação)", false, $userG->id, $idForm);
                }

                //Elaborador
                \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " foi revisado e aprovado pela Qualidade.", false, $formulario[0]->elaborador_id, $idForm);

                
                // [E-mail -> (9)]
                $elaborador = User::where('id', '=', $formulario[0]->elaborador_id)->select('id', 'name', 'username', 'email', 'setor_id')->get();
                $setor = Setor::where('id', '=', $formulario[0]->setor_id)->select('nome')->get();

                $mergeOne = $usuariosSetorQualidade->merge($usuariosGrupoDivulgacao);
                $allUsersInvolved = $mergeOne->merge($elaborador);

                $icon = "success";
                $contentF1_P1 = "O formulário "; $codeF1 = $formulario[0]->codigo; $contentF1_P2 = " foi divulgado.";
                $labelF2 = "Setor do formulário: "; $valueF2 = $setor[0]->nome;
                $labelF3 = "Nível de acesso do formulário: "; $valueF3 = $formulario[0]->nivel_acesso; $label2_F3 = ""; $value2_F3 = "";
                $this->dispatch(new SendEmailsJob($allUsersInvolved, "Formulário divulgado",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));
                

                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_APROVADO_AREA_DE_QUALIDADE, $idForm);
                \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_FORMULARIO_DIVULGADO, $idForm);
                
                break;

            default: 
                # code...
                break;
        }

        return redirect()->route('formularios')->with('approval_success', 'message');
    }

    protected function rejectForm(Request $request) {
        $responsavelPelaAcao = User::join('setor', 'setor.id', '=', 'users.setor_id')->where('setor.id', '=', Auth::user()->setor_id)->where('users.id', '=', Auth::user()->id)->select('name', 'nome')->get();
        $idForm = $request->formulario_id;

        $formulario = Formulario::where('id', '=', $idForm)->get();
        $workflow_form = WorkflowFormulario::where('formulario_id', '=', $idForm)->get();
        
        switch ($request->etapa_form) {
            case 2: // Qualidade

                $workflow_form[0]->etapa_num = Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM;
                $workflow_form[0]->etapa = Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO;
                $workflow_form[0]->justificativa = $request->justificativaReprovacaoForm;
                $workflow_form[0]->save();

                // Notificações
                $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
                foreach ($usuariosSetorQualidade as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formuláro " . $formulario[0]->codigo . " foi revisado e rejeitado pela Qualidade.", false, $user->id, $idForm);
                }

                \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " precisa ser corrigido.", true, $formulario[0]->elaborador_id, $idForm);

                // [E-mail -> (8)]  
                $elaborador = User::where('id', '=', $formulario[0]->elaborador_id)->select('id', 'name', 'username', 'email', 'setor_id')->get();

                $icon = "error";
                $contentF1_P1 = "O formulário "; $codeF1 = $formulario[0]->codigo; $contentF1_P2 = "foi rejeitado.";
                $labelF2 = "Foram solicitadas mudanças no arquivo. "; $valueF2 = "Visualize a justificativa!";
                $labelF3 = "Usuário solicitante: "; $valueF3 = $responsavelPelaAcao[0]->name; $label2_F3 = " / Solicitado por: "; $value2_F3 = "Setor " . $responsavelPelaAcao[0]->nome;
                $this->dispatch(new SendEmailsJob($elaborador, "Formulário rejeitado",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));

                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_REJEITADO_QUALIDADE, $idForm);
                \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO, $idForm);
                break;
            
            default: 
                # code...
                break;
        }

        return redirect()->route('formularios')->with('reject_success', 'message');
    }

    protected function resendForm(Request $request) {
        $idForm = $request->formulario_id;
        $file   = $request->file('new_form', 'local');
        $formulario     = Formulario::where('id', '=', $idForm)->get();
        $workflow_form  = WorkflowFormulario::where('formulario_id', '=', $idForm)->get();
        $filename = \App\Classes\Helpers::instance()->escapeFilename($formulario[0]->nome);

        // Exclui Formulário Antigo
        \Storage::disk('speed_office')->delete('formularios/' . $formulario[0]->nome . "." . $formulario[0]->extensao);

        // Salva novo formulário com o mesmo nome
        \Storage::disk('speed_office')->put('formularios/' . $filename . "." . $formulario[0]->extensao, file_get_contents($file), 'private');
        
        $formulario[0]->nome = $filename;
        $formulario[0]->save();

        $workflow_form[0]->etapa_num     = Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
        $workflow_form[0]->etapa         = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
        $workflow_form[0]->justificativa = '';
        $workflow_form[0]->save();

        // Notificações
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        foreach ($usuariosSetorQualidade as $key => $user) {
            \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " precisa ser analisado.", true, $user->id, $idForm);
        }

        // [E-mail -> (10)]
        $setor = Setor::where('id', '=', $formulario[0]->setor_id)->select('nome')->get();
        $elaborador = User::where('id', '=', $formulario[0]->elaborador_id)->select('name')->get();

        $icon = "info";
        $contentF1_P1 = "O formulário "; $codeF1 = $formulario[0]->codigo; $contentF1_P2 = " requer análise.";
        $labelF2 = "Setor do formulário: "; $valueF2 = $setor[0]->nome;
        $labelF3 = "Enviado por: "; $valueF3 = $elaborador[0]->name; $label2_F3 = ""; $value2_F3 = "";
        $this->dispatch(new SendEmailsJob($usuariosSetorQualidade, "Novo formulário para aprovação",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));


        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_REENVIADO_COLABORADOR, $idForm);
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE, $idForm);


        return redirect()->route('formularios')->with('resend_success', 'message');
    }



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

    public function getFormsIndex() {
        $base_query = DB::table('formulario')
                                ->join('workflow_formulario',   'workflow_formulario.formulario_id',    '=',    'formulario.id')
                                ->select('formulario.*', 
                                        'workflow_formulario.id AS wkf_id', 'workflow_formulario.etapa_num', 'workflow_formulario.etapa'
                                );

        $clonedBaseQuery2 = clone $base_query;
        $clonedBaseQuery3 = clone $base_query;
        $clonedBaseQuery4 = clone $base_query;
        $clonedBaseQuery5 = clone $base_query;
        $clonedBaseQuery6 = clone $base_query;


        $forms_NAOFinalizados = array(); 
        $formsFinalizados = array(); 

        // A) FORMS não finalizados
        if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) {
            $formsQualidade = $clonedBaseQuery2->where('formulario.finalizado', '=', false)->get();

            if( count($formsQualidade) > 0 ) 
                for ($i=0; $i < count($formsQualidade); $i++) 
                    $forms_NAOFinalizados[] = $formsQualidade[$i]; 

        } else if( Auth::user()->setor_id != Constants::$ID_SETOR_QUALIDADE) {
            $formsNOTQualidade = $clonedBaseQuery3->where('formulario.finalizado', '=', false)
                                                    ->where('formulario.elaborador_id', '=', Auth::user()->id)
                                                    ->where('workflow_formulario.etapa_num', '=', Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM)
                                                    ->get();

            if( count($formsNOTQualidade) > 0 ) 
                for ($i=0; $i < count($formsNOTQualidade); $i++) 
                    $forms_NAOFinalizados[] = $formsNOTQualidade[$i]; 
        }

        // B) FORMS finalizados
        $formsFinalizados_livre = $clonedBaseQuery4->where('formulario.finalizado', '=', true)
                                                    ->where('formulario.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_LIVRE)
                                                    ->get();

        $formsFinalizados_restritos = array();
        if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) {
            $formsFinalizados_restritos = $clonedBaseQuery5->where('formulario.finalizado', '=', true)
                                                            ->where('formulario.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_RESTRITO)
                                                            ->get();
        } else {
            // Como o fluxo de WF dos formulários tem apenas elaborados e qualidade e qualidade cai no if acima, só precisa verificar os que ele é elaborador
            $formsFinalizados_restritos = $clonedBaseQuery6->where('formulario.finalizado', '=', true)
                                                            ->where('formulario.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_RESTRITO)
                                                            ->where('formulario.elaborador_id', '=', Auth::user()->id)
                                                            ->get();
        } 
        
        
        if( count($formsFinalizados_livre) > 0 ) 
            for ($i=0; $i < count($formsFinalizados_livre); $i++) 
                $formsFinalizados[] = $formsFinalizados_livre[$i]; 

        if( count($formsFinalizados_restritos) > 0 ) 
            for ($i=0; $i < count($formsFinalizados_restritos); $i++) 
                $formsFinalizados[] = $formsFinalizados_restritos[$i];  



         // Criando array final para a listagem de formulários
         $forms = array();
         if( count($forms_NAOFinalizados) > 0 ) {
             usort($forms_NAOFinalizados, array($this, "cmp"));
             $forms["nao_finalizados"] = $forms_NAOFinalizados;
         }
 
         if( count($formsFinalizados) > 0 ) {
             usort($formsFinalizados, array($this, "cmp"));
             $forms["finalizados"] = $formsFinalizados;
         }
         
         return $forms;
    }

    private function cmp($a, $b) {
        return strcmp($a->nome, $b->nome);
    }

    public function filterListForms($req) {
        $list = null;
        $baseData = null;
        $formularios = $this->getFormsIndex();
        
        // Deixa os resultados em diferentes níveis hierárquicos
        $formsNAOFinalizados = ( array_key_exists("nao_finalizados", $formularios) && count($formularios["nao_finalizados"]) > 0 )  ? $formularios["nao_finalizados"] : null;
        $formsFinalizados = ( array_key_exists("finalizados", $formularios) && count($formularios["finalizados"]) > 0 )  ? $formularios["finalizados"] : null;

        if ( array_key_exists("nao_finalizados", $formularios) && count($formularios["nao_finalizados"]) > 0 ) {
            $formsNAOFinalizados = $formularios["nao_finalizados"];
            $list["nao_finalizados"] = $formularios["nao_finalizados"];
        } else {
            $formsNAOFinalizados = null;
        }

        if ( array_key_exists("finalizados", $formularios) && count($formularios["finalizados"]) > 0 )  {
            $formsFinalizados = $formularios["finalizados"] ;
            $list["finalizados"] = $formularios["finalizados"];
        } else {
            $formsFinalizados = null;
        }

        // Filtros
        if(null == $req['search_tituloFormulario'] || "" == $req['search_tituloFormulario']) {
            $arr1 = array();
            $arr2 = array();

            if($formsNAOFinalizados != null) {
                foreach ($formsNAOFinalizados as $key => $value) {
                    $add = false;
                    if($req['search_grupoDivulgacao'] != null) {
                        if( $value->grupo_divulgacao_id == $req['search_grupoDivulgacao']) $add = true;           
                        else continue;
                    }
                    if($req['search_setor'] != null) {
                        if( $value->setor_id == $req['search_setor']) $add = true;           
                        else continue;
                    }

                    if($add) $arr1[] = $value; 
                }

                $list["nao_finalizados"] = $arr1;
            }

            if($formsFinalizados != null) {
                foreach ($formsFinalizados as $key => $value) {
                    $add = false;
                    if($req['search_grupoDivulgacao'] != null) {
                        if( $value->grupo_divulgacao_id == $req['search_grupoDivulgacao']) $add = true;           
                        else continue;
                    }
                    if($req['search_setor'] != null) {
                        if( $value->setor_id == $req['search_setor']) $add = true;           
                        else continue;
                    }
                    
                    if($add) $arr2[] = $value; 
                }

                $list["finalizados"] = $arr2;
            }        

        } else {
            $arr1 = array();
            $arr2 = array();
            
            if($formsNAOFinalizados != null) {
                foreach ($formsNAOFinalizados as $key => $value) {
                    if( stripos($value->nome, $req['search_tituloFormulario']) !== false  ) {
                        $arr1[] = $value; 
                    }
                }
                $list["nao_finalizados"] = $arr1;
            }

            if($formsFinalizados != null) {
                foreach ($formsFinalizados as $key => $value) {
                    if( stripos($value->nome, $req['search_tituloFormulario']) !== false  ) {
                        $arr2[] = $value; 
                    }
                }
                $list["finalizados"] = $arr2;
            }
        }

        return $list;
    }

    
}
