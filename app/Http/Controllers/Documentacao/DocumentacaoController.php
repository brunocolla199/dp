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
        // Valores 'comuns' necessários
        $tipoDocumentos    = TipoDocumento::where('id', '<=', '3')->orderBy('nome_tipo')->get()->pluck('nome_tipo', 'id');
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'id');
        $gruposTreinamento = GrupoTreinamento::orderBy('nome')->get()->pluck('nome', 'id');
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id');

        // Aprovadores
        $diretores_aprovadores = User::where('setor_id', '=', Constants::$ID_TIPO_SETOR_DIRETORIA)->orderBy('name')->get()->pluck('name', 'id');
        $gerentes_aprovadores  = User::where('setor_id', '=', Constants::$ID_TIPO_SETOR_GERENCIA)->orderBy('name')->get()->pluck('name', 'id'); 

        // Área de Interesse
        $setoresUsuarios = [];
        $todosSetores = Setor::all();
        foreach($todosSetores as $key => $setor) {
            $arrUsers = [];
            $users = User::where('setor_id', '=', $setor->id)->get();
            foreach($users as $key => $user) {
                $arrUsers[$user->id] = $user->name;
            }
            $setoresUsuarios[$setor->nome] = $arrUsers;
        }

        // Documentos já criados (para listagem)
        $documentos  = DB::table('documento')
                            ->join('dados_documento',   'dados_documento.documento_id', '=', 'documento.id')
                            ->join('workflow',          'workflow.documento_id',        '=', 'documento.id')
                            ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                            ->select('documento.*', 
                                        'dados_documento.id AS dd_id', 'dados_documento.validade', 'dados_documento.versao',
                                        'workflow.id AS wkf_id', 'workflow.etapa', 
                                        'tipo_documento.id AS tp_doc_id', 'tipo_documento.nome_tipo'
                            )->get();


        return view('documentacao.index', ['tipoDocumentos' => $tipoDocumentos, 'diretores_aprovadores' => $diretores_aprovadores, 'gerentes_aprovadores' => $gerentes_aprovadores,
                                            'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao, 
                                            'setores' => $setores, 
                                            'setoresUsuarios' => $setoresUsuarios, 
                                            'documentos' => $documentos ]);
    }


    public function validateData(DadosNovoDocumentoRequest $request) {        
        $tipo_documento          = $request->tipo_documento;
        $text_tipo_documento     = TipoDocumento::where('id', '=', $request->tipo_documento)->get();

        $aprovador               = $request->aprovador;
        $text_aprovador          = User::where('id', '=', $request->aprovador)->get();

        $grupoTreinamento        = $request->grupoTreinamento;
        $text_grupoTreinamento   = GrupoTreinamento::where('id', '=', $request->grupoTreinamento)->get();

        $grupoDivulgacao         = $request->grupoDivulgacao;
        $text_grupoDivulgacao    = GrupoDivulgacao::where('id', '=', $request->grupoDivulgacao)->get();

        $setorDono               = $request->setor_dono_doc;
        $text_setorDono          = Setor::where('id', '=', $setorDono)->get();
        
        $copiaControlada         = ($request->copiaControlada) ? true : false;
        $text_copiaControlada    = ($request->copiaControlada) ? 'Sim' : 'Não';

        $tituloDocumento         = $request->tituloDocumento;
        $validadeDocumento       = $request->validadeDocumento;

        $acao                    = $request->action;
        $areaInteresse           = $request->areaInteresse;        
        
        // Define código do documento
        $qtdDocs = DB::table('documento')
                        ->join('dados_documento',   'dados_documento.documento_id', '=', 'documento.id')
                        ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                        ->select('documento.id')
                        ->where('documento.tipo_documento_id', '=', $tipo_documento)
                        ->where('dados_documento.setor_id', '=', $setorDono)
                        ->get()->count();

        $codigo = 0;
        if( count($qtdDocs) <= 0 )  {
           $codigo = $this->buildCodDocument(1);
        } else { 
            $codigo = $this->buildCodDocument($qtdDocs + 1);
        }

        // Concatena e gera o código final
        $codigo_final = $text_tipo_documento[0]->sigla . "-";
        $codigo_final .= ($text_tipo_documento[0]->sigla == "IT") ? $text_setorDono[0]->sigla : "";
        $codigo_final .= $codigo;

        return view('documentacao.define-documento', ['tipo_documento' => $tipo_documento, 'text_tipo_documento' => $text_tipo_documento[0]->nome_tipo,
                                                        'aprovador' => $aprovador, 'text_aprovador' => $text_aprovador[0]->name,
                                                        'grupoTreinamento' => $grupoTreinamento, 'text_grupoTreinamento' => $text_grupoTreinamento[0]->nome, 
                                                        'grupoDivulgacao' => $grupoDivulgacao, 'text_grupoDivulgacao' => $text_grupoDivulgacao[0]->nome, 
                                                        'setorDono' => $setorDono, 'text_setorDono' => $text_setorDono[0]->nome, 
                                                        'copiaControlada' => $copiaControlada, 'text_copiaControlada' => $text_copiaControlada,
                                                        'tituloDocumento' => $tituloDocumento, 'codigoDocumento' => $codigo_final, 'validadeDocumento' => $validadeDocumento, 
                                                        'acao' => $acao, 'areaInteresse' => $areaInteresse ]);
    }


    public function saveAttachedDocument(Request $request) { // USAR QUANDO TIVER TEMPO: UploadDocumentRequest
        $novoDocumento = $request->all();

        // Popular a tabela 'documento' e, em seguida, as tabelas: 'dados_dcumento', 'area_interesse_documento', 'workflow'
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
            
            // Populando a tabela DADOS_DOCUMENTO [Quando tiver tempo, verificar se deu certo a inserção do documento]
            $dados_documento = new DadosDocumento();
            $dados_documento->validade              = $novoDocumento['validadeDocumento'];
            $dados_documento->versao                = 1.0;
            $dados_documento->status                = true;
            $dados_documento->observacao            = "Documento Novo";
            $dados_documento->copia_controlada      = $novoDocumento['copiaControlada'];
            $dados_documento->setor_id              = $novoDocumento['setor_dono_doc'];
            $dados_documento->grupo_treinamento_id  = $novoDocumento['grupoTreinamento'];
            $dados_documento->grupo_divulgacao_id   = $novoDocumento['grupoDivulgacao'];
            $dados_documento->aprovador_id          = $novoDocumento['id_aprovador'];
            $dados_documento->documento_id          = $documento->id; // id que acabou de ser inserido no 'save' acima
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

            
            // Quando tiver tempo, verificar se deu certo a inserção dos dados do documento
            $workflow = new Workflow();
            $workflow->etapa        = Constants::$ETAPA_WORKFLOW_ANALISE_AREA_DE_INTERESSE;
            $workflow->observacao   = "";
            $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
            $workflow->save();
         //}
        
        return View::make('documentacao.define-documento', array('overlay_sucesso' => 'valor'));
    }


    public function saveNewDocument(Request $request) { 
        
        $novoDocumento = $request->all();
        $titulo   = $novoDocumento['tituloDocumento'];
        $codigo   = $novoDocumento['codigoDocumento'];
        $extensao = 'docx';

        //Criando Header Padrão Arquivo Word
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection(['marginTop'=>0]);
        $header = $section->createHeader();
        $header->addImage(public_path() . '/images/dpword_header_bg.png', array('width'=>600, 'height'=>130, 'marginLeft'=>0,'marginTop'=>-100, 'positioning' => 'absolute', 'posHorizontal' => 'right'));

		// Estilos da Tabela & Cabeçalho
        $tableCellStyle 		= array('valign' => 'center');
        $tableCellBkgStyle 		= array('bgColor' => 'E8EAF6');
        $tableFontStyle 		= array('bold' => true, 'color'=>'ffffff', 'align'=>'right');

        // 'Forçando' estilo da tabela, porque ela estava perdendo as bordas quando este arquivo era salvo com 'storeAs' do Laravel
        $table_style = new \PhpOffice\PhpWord\Style\Table;
        $table_style->setBorderSize(0);
        $table_style->setUnit(\PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT);
        $table_style->setWidth(3000);
        $table_style->setAlignment('right');

        $table = $header->addTable($table_style);
        $table->addRow();
        $table->addCell(151, $tableCellStyle)->addText('Documento Tipo:'.$novoDocumento['codigoDocumento'], $tableFontStyle);
        $table->addRow();
        $table->addCell(151, $tableCellStyle)->addText($titulo, $tableFontStyle);
        $table->addRow();
        $table->addCell(151, $tableCellStyle)->addText('Código:'.$codigo, $tableFontStyle);
        $table->addCell(151, $tableCellStyle)->addText('Revisão:', $tableFontStyle);
        $table->addCell(151, $tableCellStyle)->addText('Data:'.date('d/m/Y'), $tableFontStyle);

        // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $this->getNewDocumentHeader($novoDocumento));
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>'.str_replace('<br>', '<br/>', $novoDocumento['docData']));
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($titulo.'.docx');

        //Salvando local
        $full_path_dest = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix('uploads/'.$titulo.'.docx');
        
        File::move($titulo.'.docx', $full_path_dest);
        

        $documento = new Documento();
        $documento->nome                 = $titulo;
        $documento->codigo               = $codigo;
        $documento->extensao             = $extensao;
        $documento->tipo_documento_id    = $novoDocumento['tipo_documento'];
        $documento->save();
        
        // Populando a tabela DADOS_DOCUMENTO [Quando tiver tempo, verificar se deu certo a inserção do documento]
        $dados_documento = new DadosDocumento();
        $dados_documento->validade              = $novoDocumento['validadeDocumento'];
        $dados_documento->versao                = 1.0;
        $dados_documento->status                = true;
        $dados_documento->observacao            = "Documento Novo";
        $dados_documento->copia_controlada      = $novoDocumento['copiaControlada'];
        $dados_documento->setor_id              = $novoDocumento['setor_dono_doc'];
        $dados_documento->grupo_treinamento_id  = $novoDocumento['grupoTreinamento'];
        $dados_documento->grupo_divulgacao_id   = $novoDocumento['grupoDivulgacao'];
        $dados_documento->aprovador_id          = $novoDocumento['id_aprovador'];
        $dados_documento->documento_id          = $documento->id; // id que acabou de ser inserido no 'save' acima
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

        
        // Quando tiver tempo, verificar se deu certo a inserção dos dados do documento
        $workflow = new Workflow();
        $workflow->etapa        = Constants::$ETAPA_WORKFLOW_ANALISE_AREA_DE_INTERESSE;
        $workflow->observacao   = "";
        $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
        $workflow->save();

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
