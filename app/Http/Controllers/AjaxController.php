<?php

namespace App\Http\Controllers;

use App\Classes\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Log, Storage};
use App\{Anexo, AreaInteresseDocumento, ControleRegistro, CopiaControlada, DadosDocumento, Documento, DocumentoFormulario, DocumentoObservacao, Formulario, FormularioRevisao, GrupoDivulgacaoDocumento, GrupoTreinamentoDocumento, Notificacao, NotificacaoFormulario, Setor, User};

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
            $relacoes = DadosDocumento::where('aprovador_id', $request->id_user)->where('setor_id', $request->id_setor)->get();

            if( $relacoes->count() > 0 ) {
                $idsDocumentos = $relacoes->pluck('documento_id');
                $codigosDocumentos = Documento::whereIn('id', $idsDocumentos)->get()->pluck('codigo')->toArray();

                return response()->json(['response' => 'user_linked', 'codes' => $codigosDocumentos]);        
            } else {
                $aprovSetor = DB::table('aprovador_setor')->where([
                    ['usuario_id', '=', $request->id_user],
                    ['setor_id', '=', $request->id_setor]
                ])->delete();
            }
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


    public function setPermissaoElaborador(Request $_request) {
        $user = User::find($_request->user_id);
        $user->permissao_elaborador = $_request->valor_permissao_elaborador;
        $user->save();

        return response()->json(['response' => 'success']);
    }


    public function setPermissaoAprovarListaPresenca(Request $_request) {
        $user = User::find($_request->user_id);
        $user->permissao_aprovar_lista_presenca = $_request->valor_permissao_aprovar_lista;
        $user->save();

        return response()->json(['response' => 'success']);
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


    public function okJustifyCancelRequest(Request $request) {
        $dadosDoc = DadosDocumento::where('documento_id', '=', $request->document_id)->get();
        $dadosDoc[0]->id_usuario_solicitante = null;
        $dadosDoc[0]->justificativa_cancelar_revisao = null;
        $dadosDoc[0]->save();
        
        return response()->json(['response' => 'success']);    
    }


    public function saveAttachedDocument(Request $request) // USAR QUANDO TIVER TEMPO: UploadDocumentRequest
    {
        $novoDocumento = $request->all();

        $file = $request->file('doc_uploaded', 'local');
        $extensao = $file->getClientOriginalExtension();
        $titulo   = \App\Classes\Helpers::instance()->escapeFilename($novoDocumento['tituloDocumento']) . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . "00";
        $codigo   = $novoDocumento['codigoDocumento'];
        $path     = Storage::disk('speed_office')->putFileAs('', $file, $titulo . "." . $extensao);
        

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
        $dados_documento->elaborador_id                     = Auth::user()->id;
        $dados_documento->aprovador_id                      = $novoDocumento['id_aprovador'];
        $dados_documento->documento_id                      = $documento->id; // id que acabou de ser inserido no 'save' acima
        $dados_documento->save();
        
        // Populando a tabela de vinculação DOCUMENTO -> USUÁRIO
        if (isset($novoDocumento['areaInteresse']) && count($novoDocumento['areaInteresse']) > 0) {
            foreach ($novoDocumento['areaInteresse'] as $key => $user) {
                $areaInteresseDocumento = new AreaInteresseDocumento();
                $areaInteresseDocumento->documento_id  = $documento->id;
                $areaInteresseDocumento->usuario_id  = $user;
                $areaInteresseDocumento->save();
            }
        }

        // Populando a NOVA tabela de vinculação (GrupoTreinamentoDocumento)
        if (isset($novoDocumento['grupoTreinamentoDocumento']) && count($novoDocumento['grupoTreinamentoDocumento']) > 0) {
            foreach ($novoDocumento['grupoTreinamentoDocumento'] as $key => $user) {
                $novoGrupTreinamDocumento = new GrupoTreinamentoDocumento();
                $novoGrupTreinamDocumento->documento_id  = $documento->id;
                $novoGrupTreinamDocumento->usuario_id    = $user;
                $novoGrupTreinamDocumento->save();
            }
        }
        
        // Populando a NOVA tabela de vinculação (GrupoDivulgacaoDocumento)
        if (isset($novoDocumento['grupoDivulgacaoDocumento']) && count($novoDocumento['grupoDivulgacaoDocumento']) > 0) {
            foreach ($novoDocumento['grupoDivulgacaoDocumento'] as $key => $user) {
                $novoGrupDivulgDocumento = new GrupoDivulgacaoDocumento();
                $novoGrupDivulgDocumento->documento_id  = $documento->id;
                $novoGrupDivulgDocumento->usuario_id    = $user;
                $novoGrupDivulgDocumento->save();
            }
        }

        //Populando a tabela de vinculação Documento -> Formulários
        if (isset($novoDocumento['formsAtrelados']) && count($novoDocumento['formsAtrelados']) > 0) {
            foreach ($novoDocumento['formsAtrelados'] as $key => $form) {
                $documentoFormulario = new DocumentoFormulario();
                $documentoFormulario->documento_id  = $documento->id;
                $documentoFormulario->formulario_id = $form;
                $documentoFormulario->save();
            }
        }

        return response()->json(['response' => $documento->id]);
    }


    public function saveNewDocument(Request $request) {  
        
        $novoDocumento = $request->all();
        $titulo   =  \App\Classes\Helpers::instance()->escapeFilename($novoDocumento['tituloDocumento']);
        $codigo   = $novoDocumento['codigoDocumento']; 
        $extensao = 'docx';

        // Storage::disk('speed_office')->move($titulo.'.docx', $titulo . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . '00.docx'); 

        $documento = new Documento();
        $documento->nome                 = $titulo . Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS . "00";
        $documento->codigo               = $codigo;
        $documento->extensao             = $extensao;
        $documento->tipo_documento_id    = $novoDocumento['tipo_documento'];
        $documento->save();
        
        // Populando a tabela DADOS_DOCUMENTO [Quando tiver tempo, verificar se deu certo a inserção do documento]
        $dados_documento = new DadosDocumento();
        $dados_documento->validade                          = $novoDocumento['validadeDocumento'];
        $dados_documento->validade_anterior                 = $dados_documento->validade;
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
        
        // Populando a NOVA tabela de vinculação (GrupoTreinamentoDocumento)
        if( isset($novoDocumento['grupoTreinamentoDocumento']) && count($novoDocumento['grupoTreinamentoDocumento']) > 0 ) {
            foreach($novoDocumento['grupoTreinamentoDocumento'] as $key => $user) {
                $novoGrupTreinamDocumento = new GrupoTreinamentoDocumento();
                $novoGrupTreinamDocumento->documento_id  = $documento->id;
                $novoGrupTreinamDocumento->usuario_id    = $user;
                $novoGrupTreinamDocumento->save();
            }
        }
        
        // Populando a NOVA tabela de vinculação (GrupoDivulgacaoDocumento)
        if( isset($novoDocumento['grupoDivulgacaoDocumento']) && count($novoDocumento['grupoDivulgacaoDocumento']) > 0 ) {
            foreach($novoDocumento['grupoDivulgacaoDocumento'] as $key => $user) {
                $novoGrupDivulgDocumento = new GrupoDivulgacaoDocumento();
                $novoGrupDivulgDocumento->documento_id  = $documento->id;
                $novoGrupDivulgDocumento->usuario_id    = $user;
                $novoGrupDivulgDocumento->save();
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

        return response()->json(['response' => $documento->id]);   
    }


    public function refreshFormsLinked(Request $_request) {
        if( isset($_request->forms) && count($_request->forms) > 0 ) {            
            DocumentoFormulario::where('documento_id', $_request->document_id)->delete();
            
            foreach($_request->forms as $key => $form) {
                $documentoFormulario = new DocumentoFormulario();
                $documentoFormulario->documento_id  = $_request->document_id;
                $documentoFormulario->formulario_id = $form;
                $documentoFormulario->save();
            }
        } else {
            DocumentoFormulario::where('documento_id', $_request->document_id)->delete();
        }
        return response()->json(['response' => "success"]);
    }


    // Formulários
    public function okJustifyCancelFormReviewRequest(Request $request) {
        $form = Formulario::where('id', '=', $request->form_id)->get();
        $form[0]->id_usuario_solicitante = null;
        $form[0]->justificativa_cancelar_revisao = null;
        $form[0]->save();
        
        return response()->json(['response' => 'success']);    
    }


    function getFileListAllFormRevisions(Request $request) {
        $revisoes = FormularioRevisao::where('formulario_id', '=', $request->form_id)->get();
        foreach ($revisoes as $key => $value) {
            $value['encodeFilePath'] = $value->nome_completo;
        }
        return response()->json(['response' => $revisoes]);  
    }


    public function updateCode(Request $request) 
    {
        
        try {

            $formId = $request->formulario_id;
            $newCode = $request->codigo;

            $form = Formulario::find($formId);

            $oldCode = $form->codigo;

            $form->codigo = $newCode;
            $form->save();            

            $this->updateNotificationForm($formId, $newCode, $oldCode);

            return response()->json(['response' => 'success']);

        } catch (\Throwable $th) {
            Log::error("### WEE_LOG ### Erro ao atualizar códigos do formulário: " . $th->getMessage());
            return response()->json(['response' => $th]);        
        }
    }
    

    public function updateNotificationForm($formId, $newCode, $oldCode)
    {
        
        try {

            $notifications = NotificacaoFormulario::where('formulario_id', $formId)->where('texto', 'LIKE', "%$oldCode%")->get();
            foreach ($notifications as $key => $notify) {
                $newText = str_replace($oldCode, $newCode, $notify->texto);
                $notify->texto = $newText;
                $notify->save();
            }
    
            $recordControl = ControleRegistro::where('formulario_id', $formId)->first();
            if( !empty($recordControl) ) {
                $recordControl->codigo = $newCode;
                $recordControl->save();
            }
        
            return response()->json(['response' => 'success']);
        } catch (\Throwable $th) {
            Log::error("### WEE_LOG ### Erro ao atualizar códigos dos formulários nas notificações: " . $th->getMessage());
            return response()->json(['response' => $th]);
        }
    }


    public function checkIfCodeExists(Request $request)
    {
        $exist = false;

        if (array_key_exists('formulario_id', $request->all())) {
            $forms = Formulario::where('codigo', $request->codigo)->where('obsoleto', false)->get();
            if ($forms->count() > 0) {
                foreach ($forms as $form) {
                    if ($form->id != $request->formulario_id) $exist = true;
                }
            }
        } else {
            $forms = Formulario::where('codigo', $request->codigo)->where('obsoleto', false)->get();
            if ($forms->count() > 0) $exist = true;
        }

        return response()->json(['exist' => $exist]);
    }


    public function checkIfDocumentCodeExists(Request $request)
    {
        $exist = false;
        
        if (array_key_exists('documento_id', $request->all())) {
            $docs = Documento::whereHas('dados', function ($q) {
                $q->where('obsoleto', false);
            })->where('codigo', $request->codigo)->get();
            if ($docs->count() > 0) {
                foreach ($docs as $doc) {
                    $exist = true;
                }
            }
        } else {
            $docs = Documento::whereHas('dados', function ($q) {
                $q->where('obsoleto', false);
            })->where('codigo', $request->codigo)->get();
            if ($docs->count() > 0) {
                $exist = true;
            }
        }
        return response()->json(['exist' => $exist]);
    }


    // Anexos
    public function saveAttachment(Request $request)
    {
        $files = $request->file('anexo_escolhido', 'local');

        foreach ($files as $key => $file) {
            $extensao = $file->getClientOriginalExtension();

            $nome = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $hash = rand(000000000000000, 999999999999999);

            Storage::disk('speed_office')->put('/anexos/' . $hash . "." . $extensao, file_get_contents($file), 'private');

            $anexo = new Anexo();
            $anexo->nome = $nome;
            $anexo->hash = $hash;
            $anexo->extensao = $extensao;
            $anexo->documento_id = $request->document_id;
            $anexo->save();
        }

        return response()->json(['response' => 'success']);
    }


    public function getAnexos(Request $request)
    {
        $anexos = Anexo::where('documento_id', '=', $request->document_id)->orderBy('nome')->get();
        foreach ($anexos as $key => $value) {
            $value['encodeFilePath'] = $value->hash . "." . $value->extensao;
        }
        return response()->json(['response' => $anexos]);
    }


    public function removeAttachment(Request $request) {
        $anexo = Anexo::where('id', '=', $request->anexo_id)->where('documento_id', '=', $request->documento_id)->get();
        $filename = $anexo[0]->hash . "." . $anexo[0]->extensao;

        Storage::disk('speed_office')->delete('anexos/' . $filename);
        $anexo[0]->delete();

        return response()->json(['response' => 'success']);  
    }
    
    
    
    // Notificações
    public function cleanAll(Request $request) {
        $docNotifications = Notificacao::where('usuario_id', '=', Auth::user()->id)->get();
        foreach ($docNotifications as $key => $value) {
            $value->delete();
        }
        
        $formNotifications = NotificacaoFormulario::where('usuario_id', '=', Auth::user()->id)->get();
        foreach ($formNotifications as $key => $value) {
            $value->delete();
        }
        return response()->json(['response' => $formNotifications]);  
    }


    // Cópia Controlada
    public function saveControlledCopy(Request $request) {
        try {
            $novoRegistro                = new CopiaControlada();
            $novoRegistro->numero_copias = (int) $request->numeroDeCopias;
            $novoRegistro->revisao       = $request->revisaoDasCopias;
            $novoRegistro->setor         = $request->setorDasCopias;
            $novoRegistro->documento_id  = $request->idDoc;
            $novoRegistro->usuario_id    = $request->responsavel;
            $novoRegistro->save();

            $copias = $this->getListaCopias($request->idDoc);
            return response()->json(['response' => $copias]);  
        } catch(\Exception $e) {
            return response()->json(['error' => $e]);  
        }
    }


    public function getCopias(Request $_request) {
        try {
            $copias = $this->getListaCopias($_request->idDoc);
            return response()->json(['response' => $copias]);  
        } catch(\Exception $e) {
            return response()->json(['error' => $e]);  
        }
    }


    public function removeCopy(Request $_request) {
        try {
            $copiaControlada = CopiaControlada::where('id', '=', $_request->idCC)->where('documento_id', '=', $_request->idDoc)->first();
            $copiaControlada->delete();
            
            $copias = $this->getListaCopias($_request->idDoc);
            return response()->json(['response' => $copias]);    
        } catch(\Exception $e) {
            return response()->json(['error' => $e]);  
        }
    }


    private function getListaCopias(int $idDoc) {
        $copias = CopiaControlada::where('documento_id', '=', $idDoc)->orderBy('numero_copias')->get();
        foreach ($copias as $copia) {
            $copia['responsavel'] = $copia->responsavel;
        }

        return $copias;
    }

    public function getListAprovadores(Request $_request)
    {
        return User::join('aprovador_setor', 'aprovador_setor.usuario_id', '=', 'users.id')
            ->where('aprovador_setor.setor_id', '=', $_request->setor)
            ->orderBy("name", "ASC")
            ->get()->pluck('name', 'usuario_id')->toArray();
    }
}
