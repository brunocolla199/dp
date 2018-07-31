<?php

namespace App\Http\Controllers\Formularios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DadosNovoFormularioRequest;
use App\GrupoDivulgacao;
use App\Setor;
use App\Documento;
use App\Formulario;
use App\NotificacaoFormulario;
use App\TipoDocumento;
use Illuminate\Support\Facades\View;
use App\Configuracao;
use App\User;
use App\WorkflowFormulario;
use App\Classes\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FormulariosController extends Controller
{
    
    public function index() {
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id');
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'id');
        $documentos        = Documento::join('tipo_documento','tipo_documento.id','=', 'documento.tipo_documento_id')->get(['documento.id as doc_id', 'nome', 'nome_tipo', 'sigla'])->groupBy('nome_tipo')->toArray();
        $formularios       = Formulario::join('workflow_formulario', 'workflow_formulario.formulario_id', '=', 'formulario.id')->get();
        // $formularios = $this->filterFormsIndex();
        // dd($formularios);
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

    public function saveNewForm(Request $request){
        
        $formulario = new Formulario();
        $formulario->nome                 = $request->tituloFormulario;
        $formulario->codigo               = $request->codigoFormulario;
        $formulario->conteudo             = $request->formData;
        $formulario->setor_id             = $request->setor_dono_form;
        $formulario->grupo_divulgacao_id  = $request->grupoDivulgacao;
        $formulario->nivel_acesso         = $request->nivel_acesso;
        $formulario->finalizado           = false;
        $formulario->elaborador_id        = Auth::user()->id;
        $formulario->tipo_documento_id    = Constants::$ID_TIPO_DOCUMENTO_FORMULARIO;
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

        // Grava histórico do documento
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_EMISSAO, $formulario->id);
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE, $formulario->id);

         return View::make('formularios.define-formulario', array('overlay_sucesso' => 'valor'));
    
    }

    public function viewForm(Request $request){ 
        if( array_key_exists("notify_id", $request->all()) ) {
            \App\Classes\Helpers::instance()->atualizaNotificacaoFormVisualizada($request->notify_id);
        }       
        
        $formulario   = Formulario::where('id', '=', $request->formulario_id)->get();    
        $workflowForm = WorkflowFormulario::where('formulario_id', '=', $request->formulario_id)->get();

        return View::make('formularios.view-formulario', array(
            'nome'=>$formulario[0]->nome,  
            'acao'=>$request->action,  
            'formulario_id'=>$request->formulario_id, 
            'codigo'=>$formulario[0]->codigo, 
            'extensao'=>$formulario[0]->extensao,
            'filePath'=>\URL::to('/download/'.$formulario[0]->nome.".".$formulario[0]->extensao), 
            'formData'=>trim($formulario[0]->conteudo, '"'), 
            'etapa_form'=>$workflowForm[0]->etapa_num,
            'elaborador_id'=>$formulario[0]->elaborador_id,
            'finalizado'=>$formulario[0]->finalizado,
            'resp'=>false)
        );
    }

    public function saveEditForm(Request $request){
        $formulario = Formulario::find($request->formulario_id);
        $formulario->codigo = $request->codigoFormulario;
        $formulario->conteudo = $request->formData;
        if($formulario->save()){
            return view('formularios.view-formulario',array(
                    'nome'=>$formulario->nome,  
                    'formulario_id'=>$request->formulario_id, 
                    'codigo'=>$formulario->codigo, 
                    'formData'=>trim($formulario->conteudo, '"'), 
                    'resp'=>false
                )
            );
        }
    }

    public function saveAttachedDocument(Request $request) { // USAR QUANDO TIVER TEMPO: UploadDocumentRequest  
        $file = $request->file('doc_uploaded', 'local');
        $extensao = $file->getClientOriginalExtension();
        $titulo   = $request->tituloFormulario;
        $codigo   = $request->codigoFormulario;
        \Storage::disk('public_uploads')->putFileAs('/', $file, $titulo . "." . $extensao);

        $formulario = new Formulario();
        $formulario->nome                 = $request->tituloFormulario;
        $formulario->codigo               = $request->codigoFormulario;
        $formulario->extensao             = $extensao;
        $formulario->setor_id             = $request->setor_dono_form;
        $formulario->grupo_divulgacao_id  = $request->grupoDivulgacao;
        $formulario->nivel_acesso         = $request->nivel_acesso;
        $formulario->finalizado           = false;
        $formulario->elaborador_id        = Auth::user()->id;
        $formulario->tipo_documento_id    = Constants::$ID_TIPO_DOCUMENTO_FORMULARIO;
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

        // Grava histórico do documento
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_EMISSAO, $formulario->id);
        \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE, $formulario->id);

        return View::make('formularios.define-formulario', array('overlay_sucesso' => 'valor'));
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
                $formulario[0]->finalizado = true;
                $formulario[0]->save();

                $workflow_form[0]->etapa = Constants::$DESCRICAO_WORKFLOW_FORMULARIO_DIVULGADO;
                $workflow_form[0]->save();

                // Notificações
                $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
                foreach ($usuariosSetorQualidade as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " foi revisado e aprovado pela Qualidade.", false, $user->id, $idForm);
                }
                
                $usuariosGrupoDivulgacao = GrupoDivulgacao::join('grupo_divulgacao_usuario', 'grupo_divulgacao_usuario.grupo_id', '=', 'grupo_divulgacao.id')->where('grupo_divulgacao.id', '=', $formulario[0]->grupo_divulgacao_id)->get();
                // dd($usuariosGrupoDivulgacao);
                
                //Grupo de Divulgação
                foreach ($usuariosGrupoDivulgacao as $key => $userG) {
                    \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " foi revisado e aprovado pela Qualidade. (Início da Divulgação)", false, $userG->usuario_id, $idForm);
                }

                //Elaborador
                \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " foi revisado e aprovado pela Qualidade.", false, $formulario[0]->elaborador_id, $idForm);

                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_APROVADO_AREA_DE_QUALIDADE, $idForm);
                \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_FORMULARIO_DIVULGADO, $idForm);
                
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

        return redirect()->route('formularios')->with('approval_success', 'message');
    }


    protected function rejectForm(Request $request) {
        $idForm = $request->formulario_id;

        $formulario = Formulario::where('id', '=', $idForm)->get();
        $workflow_form = WorkflowFormulario::where('formulario_id', '=', $idForm)->get();
        
        switch ($request->etapa_form) {
            case 1: // Elaborador
                # code...
                break;

            case 2: // Qualidade

                // $formulario[0]->observacao = $DESCRICAO_WORKFLOW_REJEITADO_QUALIDADE;
                // $formulario[0]->save();

                $workflow_form[0]->etapa_num = Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM;
                $workflow_form[0]->etapa = Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO_REVISAO;
                $workflow_form[0]->justificativa = $request->justificativaReprovacaoDoc;
                $workflow_form[0]->save();

                // Notificações
                $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
                foreach ($usuariosSetorQualidade as $key => $user) {
                    \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formuláro " . $formulario[0]->codigo . " foi revisado e rejeitado pela Qualidade.", false, $user->id, $idForm);
                }

                //Elaborador
                \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $formulario[0]->codigo . " precisa ser corrigido.", true, $formulario[0]->elaborador_id, $idForm);

                // Histórico
                \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_REJEITADO_QUALIDADE, $idForm);
                \App\Classes\Helpers::instance()->gravaHistoricoFormulario(Constants::$DESCRICAO_WORKFLOW_EM_ELABORACAO_REVISAO, $idForm);
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

        return redirect()->route('formularios')->with('reject_success', 'message');
    }


    protected function resendForm(Request $request) {
        
        $idForm = $request->formulario_id;

        $documento = Documento::where('id', '=', $idForm)->get();
        $workflow_form = WorkflowFormulario::where('formulario_id', '=', $idForm)->get();

        // $formulario[0]->observacao = $DESCRICAO_WORKFLOW_REENVIADO_COLABORADOR;
        // $formulario[0]->save();
        
        $workflow_form[0]->etapa_num = Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
        $workflow_form[0]->etapa = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
        $workflow_form[0]->save();

        // Notificações
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->get();
        foreach ($usuariosSetorQualidade as $key => $user) {
            \App\Classes\Helpers::instance()->gravaNotificacaoFormulario("O formulário " . $documento[0]->codigo . " precisa ser analisado.", true, $user->id, $idForm);
        }

        // Histórico
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_REENVIADO_COLABORADOR, $idForm);
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento(Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE, $idForm);

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

    public function filterFormsIndex(){

        $base_query = DB::table('formulario')
                            ->join('workflow_formulario', 'workflow_formulario.formulario_id','=', 'formulario.id')
                            ->select('*')
                            ->get();

        // dd($base_query);

        $documentos_NAOFinalizados = array(); 
        $documentosFinalizados = array(); 
        
        // A) Documentos não finalizados
        if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) {
            $documentos_NAOFinalizados_NAOConfidenciais; // todos os membros da qualidade podem ver
            $documentos_NAOFinalizados_Confidenciais = array(); // apenas um membro da qualidade pode ver
            
            $documentos_NAOFinalizados_NAOConfidenciais = $base_query->where('dados_documento.finalizado', '=', false)
                                                                        ->where('dados_documento.nivel_acesso', '!=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                                        ->get();
                                                                        
            if(Auth::user()->id == Constants::$ID_USUARIO_ADMIN_SETOR_QUALIDADE) {
                $documentos_NAOFinalizados_Confidenciais = $base_query->where('dados_documento.finalizado', '=', false)
                                                                        ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                                        ->get();                                                        
            }

            if( count($documentos_NAOFinalizados_NAOConfidenciais) > 0 ) $documentos_NAOFinalizados[] = $documentos_NAOFinalizados_NAOConfidenciais; 
            if( count($documentos_NAOFinalizados_Confidenciais) > 0 ) $documentos_NAOFinalizados[] = $documentos_NAOFinalizados_Confidenciais; 

        } else if( Auth::user()->setor_id != Constants::$ID_SETOR_QUALIDADE && Auth::user()->setor_id != Constants::$ID_SETOR_CAPITAL_HUMANO ) {

            $docs_etapa1 = $base_query
                ->where('dados_documento.finalizado', '=', false)
                ->where('workflow.etapa_num', '=', 2)
                ->where('dados_documento.elaborador_id', '=', Auth::user()->id)
                ->get();
            
            // dd($docs_etapa1);

            $docs_etapa3 = DB::table('documento')
                                ->join('dados_documento',           'dados_documento.documento_id',             '=',    'documento.id')
                                ->join('workflow',                  'workflow.documento_id',                    '=',    'documento.id')
                                ->join('tipo_documento',            'tipo_documento.id',                        '=',    'documento.tipo_documento_id')
                                ->join('area_interesse_documento', function($join) {
                                    $join->on('area_interesse_documento.documento_id', '=', 'documento.id')
                                            ->where('area_interesse_documento.usuario_id', '=', Auth::user()->id);
                                })
                                ->select('documento.*', 
                                        'dados_documento.id AS dd_id', 'dados_documento.validade', 'dados_documento.elaborador_id', 'dados_documento.aprovador_id',
                                        'workflow.id AS wkf_id', 'workflow.etapa_num', 'workflow.etapa', 
                                        'tipo_documento.id AS tp_doc_id', 'tipo_documento.nome_tipo',
                                        'area_interesse_documento.id AS aid_id', 'area_interesse_documento.documento_id AS aid_documento_id', 'area_interesse_documento.usuario_id AS aid_usuario_id'
                                )    
                                        ->where('dados_documento.finalizado', '=', false)
                                        ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_AREA_DE_INTERESSE_NUM)
                                        ->get();


            $docs_etapa4 = $base_query->where('dados_documento.finalizado', '=', false)
                                        ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_APROVADOR_NUM)
                                        ->where('dados_documento.aprovador_id', '=', Auth::user()->id)
                                        ->get();

            $docs_etapas_5_6 = $base_query->where('dados_documento.finalizado', '=', false)
                                            ->where(function ($query) {
                                                $query->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_UPLOAD_LISTA_DE_PRESENCA_NUM)
                                                    ->orWhere('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_CORRECAO_DA_LISTA_DE_PRESENCA_NUM);
                                            })
                                            ->where('dados_documento.elaborador_id', '=', Auth::user()->id)
                                            ->get();
                                            
                                            // dd($docs_etapas_5_6);
            if( count($docs_etapa1) > 0 ) $documentos_NAOFinalizados[] = $docs_etapa1; 
            if( count($docs_etapa3) > 0 ) $documentos_NAOFinalizados[] = $docs_etapa3; 
            if( count($docs_etapa4) > 0 ) $documentos_NAOFinalizados[] = $docs_etapa4; 
            if( count($docs_etapas_5_6) > 0 ) $documentos_NAOFinalizados[] = $docs_etapas_5_6; 
            
        } else if(Auth::user()->setor_id == Constants::$ID_SETOR_CAPITAL_HUMANO) {
            $docs_etapa7 = $base_query->where('dados_documento.finalizado', '=', false)
                                        ->where('workflow.etapa_num', '=', Constants::$ETAPA_WORKFLOW_CAPITAL_HUMANO_NUM)
                                        ->get();

            if( count($docs_etapa7) > 0 ) $documentos_NAOFinalizados[] = $docs_etapa7; 
        }

        
        
        // B) Documentos finalizados
        $docsFinalizados_livres = $base_query->where('dados_documento.finalizado', '=', true)
                                                ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_LIVRE)
                                                ->get();

        
        $docsFinalizados_restritos = array();
        if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE) {
            $docsFinalizados_restritos = $base_query->where('dados_documento.finalizado', '=', true)
                                                    ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_RESTRITO)
                                                    ->get();
        } else {
            $docsFinalizados_restritos = $base_query_area->where('dados_documento.finalizado', '=', true)
                                                    ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_RESTRITO)
                                                    ->where(function ($query) {
                                                        $query->where('dados_documento.elaborador_id', '=', Auth::user()->id)
                                                              ->orWhere('area_interesse_documento.usuario_id', '=', Auth::user()->id)
                                                              ->orWhere('dados_documento.aprovador_id', '=', Auth::user()->id)
                                                              ->orWhere('dados_documento.setor_id', '=', Auth::user()->setor_id);
                                                    })
                                                        ->get();
        }

        $docsFinalizados_confidenciais = array();
        if(Auth::user()->id == Constants::$ID_USUARIO_ADMIN_SETOR_QUALIDADE) {
            $docsFinalizados_confidenciais = $base_query->where('dados_documento.finalizado', '=', true)
                                                        ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                        ->get();
        } else {
            $docsFinalizados_confidenciais = $base_query_area->where('dados_documento.finalizado', '=', true)
                                                        ->where('dados_documento.nivel_acesso', '=', Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL)
                                                        ->where(function ($query) {
                                                            $query->where('dados_documento.elaborador_id', '=', Auth::user()->id)
                                                                ->orWhere('area_interesse_documento.usuario_id', '=', Auth::user()->id)
                                                                ->orWhere('dados_documento.aprovador_id', '=', Auth::user()->id);
                                                        })
                                                        ->get();
        }
    
        
        return $docs;
    }
}
