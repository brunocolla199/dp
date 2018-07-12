<?php

namespace App\Http\Controllers\Documentacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TipoDocumento;
use App\Documento;
use App\DadosDocumento;
use App\Setor;
use App\Classes\Constants;
use App\User;
use App\Workflow;
use App\Http\Requests\DadosNovoDocumentoRequest;
use App\Http\Requests\UploadDocumentRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DocumentacaoController extends Controller
{
    
    public function index() {
        $tipoDocumentos    = TipoDocumento::orderBy('nome_tipo')->get()->pluck('nome_tipo', 'id');
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'id');
        $gruposTreinamento = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_TREINAMENTO)->orderBy('nome')->get()->pluck('nome', 'id');
        $aprovadores       = User::orderBy('name')->get()->pluck('name', 'id');
        $gruposDivulgacao  = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_DIVULGACAO)->orderBy('nome')->get()->pluck('nome', 'id');
        $usuariosInteresse = User::orderBy('name')->get()->pluck('name', 'id');

        $documentos        = $users = DB::table('documento')
                                            ->join('dados_documento',   'dados_documento.documento_id', '=', 'documento.id')
                                            ->join('workflow',          'workflow.documento_id',        '=', 'documento.id')
                                            ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                                            ->select('documento.*', 'dados_documento.*', 'workflow.*', 'tipo_documento.*')
                                            ->get();

        return view('documentacao.index', ['tipoDocumentos' => $tipoDocumentos, 'setores' => $setores, 'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao, 
                                            'aprovadores' => $aprovadores, 'usuariosInteresse' => $usuariosInteresse, 'documentos' => $documentos]);
    }


    public function validateData(DadosNovoDocumentoRequest $request) {
        $tipo_documento          = $request->tipo_documento;
        $aprovador               = $request->aprovador;
        $areaTreinamento         = $request->areaTreinamento;
        $grupoDivulgacao         = $request->grupoDivulgacao;
        $grupoInteresse          = $request->grupoInteresse;
        $tituloDocumento         = $request->tituloDocumento;
        $validadeDocumento       = $request->validadeDocumento;
        $acao                    = $request->action;

        // Definindo qual é o tipo do grupo de interesse: Usuário ou Setor?
        $tipo_grupoInteresse = 0;
        if($request->tipo_area_interesse == "on") {
            $g = User::where('id', '=', $request->grupoInteresse)->get();
            $view_grupoInteresse = $g[0]->name;  
            $tipo_grupoInteresse = Constants::$ID_TIPO_GRUPO_INTERESSE_USUARIO;
        } else {
            $g = Setor::where('id', '=', $request->grupoInteresse)->get();
            $view_grupoInteresse = $g[0]->nome; 
            $tipo_grupoInteresse = Constants::$ID_TIPO_GRUPO_INTERESSE_SETOR;
        }

        $view_tipo_documento     = TipoDocumento::where('id', '=', $request->tipo_documento)->get();
        $view_aprovador          = User::where('id', '=', $request->aprovador)->get();
        $view_areaTreinamento    = Setor::where('id', '=', $request->areaTreinamento)->get();
        $view_grupoDivulgacao    = Setor::where('id', '=', $request->grupoDivulgacao)->get();

        return view('documentacao.define-documento', ['tipo_documento' => $tipo_documento, 'view_tipo_documento' => $view_tipo_documento[0]->nome,
                                                        'aprovador' => $aprovador, 'view_aprovador' => $view_aprovador[0]->name,
                                                        'areaTreinamento' => $areaTreinamento, 'view_areaTreinamento' => $view_areaTreinamento[0]->nome, 
                                                        'grupoDivulgacao' => $grupoDivulgacao, 'view_grupoDivulgacao' => $view_grupoDivulgacao[0]->nome, 
                                                        'grupoInteresse' => $grupoInteresse, 'view_grupoInteresse' => $view_grupoInteresse, 'tipo_grupoInteresse' => $tipo_grupoInteresse,
                                                        'tituloDocumento' => $tituloDocumento, 'validadeDocumento' => $validadeDocumento,'acao' => $acao]);
    }


    public function saveAttachedDocument(Request $request) { // USAR QUANDO TIVER TEMPO: UploadDocumentRequest
        $novoDocumento = $request->all();
        // dd($novoDocumento);

        // Popular a tabela 'documento' e, em seguida, as tabelas: 'dados_dcumento', 'workflow'
         //if (Input::file('doc_uploaded') != null) {
            $file = $request->file('doc_uploaded', 'local');
            $extensao = $file->getClientOriginalExtension();
            $titulo   = $novoDocumento['tituloDocumento'];
            $path     = $file->storeAs('/uploads', $titulo . "." . $extensao, 'local');

            $documento = new Documento();
            $documento->nome                 = $titulo;
            $documento->extensao             = $extensao;
            $documento->tipo_documento_id    = $novoDocumento['tipo_documento'];
            $documento->save();
            
            // Quando tiver tempo, verificar se deu certo a inserção do documento
            $dados_documento = new DadosDocumento();
            $dados_documento->validade              = $novoDocumento['validadeDocumento'];
            $dados_documento->versao                = 1.0;
            $dados_documento->status                = true;
            $dados_documento->observacao            = "";
            $dados_documento->tipo_grupo_interesse  = $novoDocumento['tipo_grupoInteresse'];
            $dados_documento->grupo_interesse_id    = $novoDocumento['grupoInteresse'];
            $dados_documento->grupo_treinamento_id  = $novoDocumento['areaTreinamento'];
            $dados_documento->grupo_divulgacao_id   = $novoDocumento['grupoDivulgacao'];
            $dados_documento->aprovador_id          = $novoDocumento['aprovador'];
            $dados_documento->documento_id          = $documento->id; // id que acabou de ser inserido no 'save' acima
            $dados_documento->save();

            
            // Quando tiver tempo, verificar se deu certo a inserção dos dados do documento
            $workflow = new Workflow();
            $workflow->etapa        = Constants::$ETAPA_WORKFLOW_AREA_DE_INTERESSE;
            $workflow->observacao   = "";
            $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
            $workflow->save();

         //}
        
        return View::make('documentacao.define-documento', array('overlay_sucesso' => 'valor'));
    }

}
