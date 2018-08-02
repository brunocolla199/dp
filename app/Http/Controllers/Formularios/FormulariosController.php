<?php

namespace App\Http\Controllers\Formularios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DadosNovoFormularioRequest;
use App\GrupoDivulgacao;
use App\Setor;
use App\Documento;
use App\Formulario;
use App\HistoricoFormulario;
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
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $documentos        = Documento::join('tipo_documento','tipo_documento.id','=', 'documento.tipo_documento_id')->get(['documento.id as doc_id', 'nome', 'nome_tipo', 'sigla'])->groupBy('nome_tipo')->toArray();
        $formularios       = $this->getFormsIndex();
        
        // $formularios1_old  = Formulario::join('workflow_formulario', 'workflow_formulario.formulario_id', '=', 'formulario.id')->get();      

        return view('formularios.index', ['formularios'=>$formularios, 'grupoDivulgacao' => $gruposDivulgacao, 'setores'=>$setores, 'documentosTipo'=>$documentos]);
    }

    public function filterFormsIndex(Request $request){
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id')->toArray();
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'id')->toArray();
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
        $historico    = HistoricoFormulario::join('formulario', 'formulario.id', '=', 'historico_formulario.formulario_id')
                                            ->join('users', 'users.id', '=', 'formulario.elaborador_id')
                                            ->where('formulario_id', '=', $request->formulario_id)->orderby('finalizado')->get();

        // dd($historico);

        return View::make('formularios.view-formulario', array(
            'nome'=>$formulario[0]->nome,  
            'acao'=>$request->action,  
            'formulario_id'=>$request->formulario_id, 
            'historico'=>$historico, 
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
