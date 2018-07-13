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
use App\Configuracao;
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
        $aprovadores       = User::orderBy('name')->get()->pluck('name', 'id');


        $tipoDocumentos    = TipoDocumento::orderBy('nome_tipo')->get()->pluck('nome_tipo', 'id');
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'id');
        $gruposTreinamento = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_TREINAMENTO)->orderBy('nome')->get()->pluck('nome', 'id');
        $gruposDivulgacao  = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_GRUPO_DE_DIVULGACAO)->orderBy('nome')->get()->pluck('nome', 'id');
        $usuariosInteresse = User::orderBy('name')->get()->pluck('name', 'id');

        $documentos  = DB::table('documento')
                            ->join('dados_documento',   'dados_documento.documento_id', '=', 'documento.id')
                            ->join('workflow',          'workflow.documento_id',        '=', 'documento.id')
                            ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                            ->select('documento.*', 
                                        'dados_documento.id AS dd_id', 'dados_documento.validade', 'dados_documento.versao',
                                        'workflow.id AS wkf_id', 'workflow.etapa', 
                                        'tipo_documento.id AS tp_doc_id', 'tipo_documento.nome_tipo'
                            )->get();


        return view('documentacao.index', ['tipoDocumentos' => $tipoDocumentos, 'setores' => $setores, 'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao, 
                                            'aprovadores' => $aprovadores, 'usuariosInteresse' => $usuariosInteresse, 'documentos' => $documentos]);
    }


    public function validateData(DadosNovoDocumentoRequest $request) {
        // $aprovador               = $request->aprovador;
        $aprovador               = 1;

        $tipo_documento          = $request->tipo_documento;
        $areaTreinamento         = $request->areaTreinamento;
        $grupoDivulgacao         = $request->grupoDivulgacao;
        $grupoInteresse          = $request->grupoInteresse;
        $setorDono               = $request->setor_dono_doc;
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
        

        // $view_aprovador          = User::where('id', '=', $request->aprovador)->get();
        $view_aprovador          = User::where('id', '=', 1)->get(); // ALINHAR QUANDO DER TEMPO
        
        $view_tipo_documento     = TipoDocumento::where('id', '=', $request->tipo_documento)->get();
        $view_areaTreinamento    = Setor::where('id', '=', $request->areaTreinamento)->get();
        $view_grupoDivulgacao    = Setor::where('id', '=', $request->grupoDivulgacao)->get();
        $view_setorDono          = Setor::where('id', '=', $setorDono)->get();
        
        // Define código do documento
        $qtdDocs = DB::table('documento')
                        ->join('dados_documento',   'dados_documento.documento_id', '=', 'documento.id')
                        ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                        ->select('documento.*', 'dados_documento.setor_id')
                        ->where('documento.tipo_documento_id', '=', $tipo_documento)
                        ->where('dados_documento.setor_id', '=', $setorDono)
                        ->get();

        $codigo = 0;
        if( count($qtdDocs) <= 0 )  {
           $codigo = $this->buildCodDocument(1);
        } else { 
            $codigo = $this->buildCodDocument($qtdDocs + 1);
        }

        // Concatena e gera o código final
        $codigo_final = $view_tipo_documento[0]->sigla . "-";
        $codigo_final .= ($view_tipo_documento[0]->sigla == "IT") ? $view_setorDono[0]->sigla : "";
        $codigo_final .= $codigo;

        return view('documentacao.define-documento', ['tipo_documento' => $tipo_documento, 'view_tipo_documento' => $view_tipo_documento[0]->nome,
                                                        'aprovador' => 1, 'view_aprovador' => $view_aprovador[0]->name,
                                                        'areaTreinamento' => $areaTreinamento, 'view_areaTreinamento' => $view_areaTreinamento[0]->nome, 
                                                        'grupoDivulgacao' => $grupoDivulgacao, 'view_grupoDivulgacao' => $view_grupoDivulgacao[0]->nome, 
                                                        'grupoInteresse' => $grupoInteresse, 'view_grupoInteresse' => $view_grupoInteresse, 'tipo_grupoInteresse' => $tipo_grupoInteresse,
                                                        'setorDono' => $setorDono, 'view_setorDono' => $view_setorDono[0]->nome, 
                                                        'tituloDocumento' => $tituloDocumento, 'codigoDocumento' => $codigo_final, 'validadeDocumento' => $validadeDocumento,'acao' => $acao]);
    }


    public function saveAttachedDocument(Request $request) { // USAR QUANDO TIVER TEMPO: UploadDocumentRequest
        $novoDocumento = $request->all();

        // Popular a tabela 'documento' e, em seguida, as tabelas: 'dados_dcumento', 'workflow'
         //if (Input::file('doc_uploaded') != null) {
            $file = $request->file('doc_uploaded', 'local');
            $extensao = $file->getClientOriginalExtension();
            $titulo   = $novoDocumento['tituloDocumento'];
            $codigo   = $novoDocumento['codigoDocumento'];
            $path     = $file->storeAs('/uploads', $titulo . "." . $extensao, 'local');

            $documento = new Documento();
            $documento->nome                 = $titulo;
            $documento->codigo               = $codigo;
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
            $dados_documento->setor_id              = $novoDocumento['setor_dono_doc'];
            $dados_documento->grupo_treinamento_id  = $novoDocumento['areaTreinamento'];
            $dados_documento->grupo_divulgacao_id   = $novoDocumento['grupoDivulgacao'];
            $dados_documento->aprovador_id          = $novoDocumento['id_aprovador'];
            $dados_documento->documento_id          = $documento->id; // id que acabou de ser inserido no 'save' acima
            $dados_documento->save();

            
            // Quando tiver tempo, verificar se deu certo a inserção dos dados do documento
            $workflow = new Workflow();
            $workflow->etapa        = Constants::$ETAPA_WORKFLOW_ANALISE_AREA_DE_INTERESSE;
            $workflow->observacao   = "";
            $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
            $workflow->save();

         //}
        
        return View::make('documentacao.define-documento', array('overlay_sucesso' => 'valor'));
    }


    public function viewDocument(Request $request) {
        return view('documentacao.view-document');
    }














    // ===========================================================  //  =========================================================== // =========================================================== // ===========================================================
    //                                                                                                              ***  Úteis abaixo ***
    // ===========================================================  //  =========================================================== // =========================================================== // ===========================================================
    

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

}
