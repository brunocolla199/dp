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


    public function filterDocumentsIndex(Request $request) {
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
        $documentos  = $this->filterListDocuments($request->all()); 

        return view('documentacao.index', ['tipoDocumentos' => $tipoDocumentos, 'diretores_aprovadores' => $diretores_aprovadores, 'gerentes_aprovadores' => $gerentes_aprovadores,
                                            'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao, 
                                            'setores' => $setores, 
                                            'setoresUsuarios' => $setoresUsuarios, 
                                            'documentos' => $documentos ]);
    }


    public function validateData(DadosNovoDocumentoRequest $request) {        
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

        $tituloDocumento         = $request->tituloDocumento;
        $validadeDocumento       = $request->validadeDocumento;

        $acao                    = $request->action;
        $areaInteresse           = $request->areaInteresse;        
        
        $codigo_final = $text_tipo_documento[0]->sigla . "-";
        $codigo = 0;
        
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


        $docData = File::get(public_path()."/doc_templates/".strtoupper($text_tipo_documento[0]->sigla).".html"); 

        return view('documentacao.define-documento', ['tipo_documento' => $tipo_documento, 'text_tipo_documento' => $text_tipo_documento[0]->nome_tipo,
                                                        'nivelAcessoDocumento' => $nivelAcessoDocumento,
                                                        'aprovador' => $aprovador, 'text_aprovador' => $text_aprovador[0]->name,
                                                        'grupoTreinamento' => $grupoTreinamento, 'text_grupoTreinamento' => $text_grupoTreinamento[0]->nome, 
                                                        'grupoDivulgacao' => $grupoDivulgacao, 'text_grupoDivulgacao' => $text_grupoDivulgacao[0]->nome, 
                                                        'setorDono' => $setorDono, 'text_setorDono' => $text_setorDono[0]->nome, 
                                                        'copiaControlada' => $copiaControlada, 'text_copiaControlada' => $text_copiaControlada,
                                                        'tituloDocumento' => $tituloDocumento, 'codigoDocumento' => $codigo_final, 'validadeDocumento' => $validadeDocumento, 
                                                        'acao' => $acao, 'areaInteresse' => $areaInteresse, 'docData'=>$docData ]);
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
            $dados_documento->nivel_acesso          = $novoDocumento['nivel_acesso'];
            $dados_documento->finalizado            = false;
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
            $workflow->etapa_num    = Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
            $workflow->etapa        = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
            $workflow->descricao    = "";
            $workflow->justificativa= "";
            $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
            $workflow->save();
         //}
        
        return View::make('documentacao.define-documento', array('overlay_sucesso' => 'valor', 'docData'=>$novoDocumento['docData']));
    }


    public function saveNewDocument(Request $request) { 
        
        $novoDocumento = $request->all();
        $titulo   = $novoDocumento['tituloDocumento'];
        $codigo   = $novoDocumento['codigoDocumento']; 
        $extensao = 'docx';

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        
        // //Criando Header Padrão Arquivo Word
        // $section = $this->createDocHeader($phpWord, $novoDocumento);

        // \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>'.str_replace('<br>', '<br/>', $novoDocumento['docData']));
        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        // $objWriter->save($titulo.'.docx');

        Storage::disk('local')->put('uploads/'.$titulo.'.html', $novoDocumento['docData']);
        
        //Salvando local
        // $full_path_dest = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix('uploads/'.$titulo.'.docx');
        
        // File::move($titulo.'.docx', $full_path_dest);
        

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
        $dados_documento->nivel_acesso          = $novoDocumento['nivel_acesso'];
        $dados_documento->finalizado            = false;
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
        $workflow->etapa_num    = Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
        $workflow->etapa        = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
        $workflow->descricao    = "";
        $workflow->justificativa= "";
        $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
        $workflow->save();

        return View::make('documentacao.define-documento', array('overlay_sucesso' => 'valor', 'docData'=>$novoDocumento['docData']));
    }


    public function viewDocument(Request $request) {

        $document_id = $request->document_id;
        
        $documento     = Documento::where('id', '=', $document_id)->get();
        $tipoDocumento = TipoDocumento::where('id', '=', $documento[0]->tipo_documento_id)->get(['nome_tipo', 'sigla']);

        if(Storage::disk('local')->exists("uploads/".$documento[0]->nome.".html")){
            $documento->docData = trim(json_encode(Storage::get("uploads/".$documento[0]->nome.".html")), '"');
        } else {
            $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

            $docPath = $storagePath."uploads/".$documento[0]->nome.".".$documento[0]->extensao;

            $phpWord = \PhpOffice\PhpWord\IOFactory::load($docPath);

            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            
            ob_start();
            $htmlWriter->save('php://output');
            $documento->docData = json_encode($this->extractHtmlDoc(ob_get_contents(), 'body'));
            ob_end_clean();
        }
    
        return view('documentacao.view-document', array('nome'=>$documento[0]->nome, 'docPath'=>$documento[0]->nome.".".$documento[0]->extensao, 'document_id'=>$document_id, 'codigo'=>$documento[0]->codigo, 'docData'=>$documento->docData, 'resp'=>false));
    }

    
    public function saveEditDocument(Request $request){
        $document_id = $request->document_id;
        $documento = Documento::find($document_id);
        $documento->codigo = $request->codigoDocumento;
        
        if($documento->save()){

            //Criando Header Padrão Arquivo Word
            // $phpWord = new \PhpOffice\PhpWord\PhpWord();

            // $section = $phpWord->addSection(['marginTop'=>0]);
            // $header = $section->createHeader();
            // $header->addImage(public_path() . '/images/dpword_header_bg.png', array('width'=>600, 'height'=>130, 'marginLeft'=>0,'marginTop'=>-100, 'positioning' => 'absolute', 'posHorizontal' => 'right'));

            // // Estilos da Tabela & Cabeçalho
            // $tableCellStyle 		= array('valign' => 'center');
            // $tableCellBkgStyle 		= array('bgColor' => 'E8EAF6');
            // $tableFontStyle 		= array('bold' => true, 'color'=>'ffffff', 'align'=>'right');

            // // 'Forçando' estilo da tabela, porque ela estava perdendo as bordas quando este arquivo era salvo com 'storeAs' do Laravel
            // $table_style = new \PhpOffice\PhpWord\Style\Table;
            // $table_style->setBorderSize(0);
            // $table_style->setUnit(\PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT);
            // $table_style->setWidth(3000);
            // $table_style->setAlignment('right');

            // $table = $header->addTable($table_style);
            // $table->addRow();
            // $table->addCell(151, $tableCellStyle)->addText('Documento Tipo:'.$request->codigoDocumento, $tableFontStyle);
            // $table->addRow();
            // $table->addCell(151, $tableCellStyle)->addText($documento->nome, $tableFontStyle);
            // $table->addRow();
            // $table->addCell(151, $tableCellStyle)->addText('Código:'.$documento->codigo, $tableFontStyle);
            // $table->addCell(151, $tableCellStyle)->addText('Revisão:', $tableFontStyle);
            // $table->addCell(151, $tableCellStyle)->addText('Última Alter:'.date('d/m/Y'), $tableFontStyle);

            // \PhpOffice\PhpWord\Shared\Html::addHtml($section, '<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>'.str_replace('<br>', '<br/>', $request->docData));
            // $objWriterWord = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            // $objWriterWord->save($documento->nome.'.docx');

            Storage::disk('local')->put('uploads/'.$documento->nome.'.html', $request->docData);
    
            //Salvando local
            // $full_path_dest = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix('uploads/'.$documento->nome.'.docx');
            
            // File::move($documento->nome.'.docx', $full_path_dest);

            $docData = trim(json_encode($request->docData), '"');
            
            return view('documentacao.view-document', array('nome'=>$documento->nome, 'docPath'=>$documento->nome.".".$documento->extensao, 'document_id'=>$document_id, 'codigo'=>$documento->codigo, 'docData'=>$docData, 'resp'=>['status'=>'success', 'msg'=>'Documento Atualizado!', 'title'=>'Sucesso!']));
        }

    }


    protected function extractHtmlDoc($html, $section){

        switch ($section) {
            case 'body':

            $lines  = explode("\n", $html);
            $isBody = false;
            $result = '';

            // dd($lines);

            foreach ($lines as $key => $line){
                if($line == '<body>') $isBody = true;

                if($line == '</body>'){
                    $isBody = false;
                    $result .= $line;
                }
                
                // if($isBody && $line !== '<p>&nbsp;</p>') $result .= str_replace("'", "\'", $line);
                if($isBody && $line !== '<p>&nbsp;</p>') $result .= str_replace("'", "\"", $line);
                
            }
            return $result;
                // return ;
                break;
            case 'head':
                break;
        }
    }


    /*
    * Função para criar o cabeçalho padrãp do DOCX de acordo com o tipo de documento 
    */
    protected function createDocHeader($phpWord, $novoDocumento){
        
        $section = $phpWord->addSection(['marginTop'=>0]);
        $header = $section->createHeader();

        $tipoDocumento = TipoDocumento::where('id', '=', $novoDocumento['tipo_documento'])->get(['nome_tipo', 'sigla']);

        switch ($tipoDocumento[0]->sigla) {
            case 'PG':
                
            break;
            
            case 'IT':
            
                $header->addImage(public_path() . '/images/doc_headers/dpword_header_it.png', array('width'=>600, 'height'=>130, 'marginLeft'=>0,'marginTop'=>-100, 'positioning' => 'absolute', 'posHorizontal' => 'right'));

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
                $table->addCell(151, $tableCellStyle)->addText('INSTRUÇÃO DE TRABALHO', $tableFontStyle);
                $table->addRow();
                $table->addCell(151, $tableCellStyle)->addText($novoDocumento['tituloDocumento'], $tableFontStyle);
                $table->addRow();
                $table->addCell(151, $tableCellStyle)->addText('Código:'.$novoDocumento['codigoDocumento'], $tableFontStyle);
                $table->addCell(151, $tableCellStyle)->addText('Revisão:', $tableFontStyle);
                $table->addCell(151, $tableCellStyle)->addText('Última Alter:'.date('d/m/Y'), $tableFontStyle);

                return $section;
            break;
        
            case 'DG':
            
                $header->addImage(public_path() . '/images/doc_headers/dpword_header_dg_vert.png', array('width'=>600, 'height'=>130, 'marginLeft'=>0,'marginTop'=>-100, 'positioning' => 'absolute', 'posHorizontal' => 'right'));

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
                $table->addCell(151, $tableCellStyle)->addText('DIRETRIZ DE GESTÃO', $tableFontStyle);
                $table->addRow();
                $table->addCell(151, $tableCellStyle)->addText($novoDocumento['tituloDocumento'], $tableFontStyle);
                $table->addRow();
                $table->addCell(151, $tableCellStyle)->addText('Código:'.$novoDocumento['codigoDocumento'], $tableFontStyle);
                $table->addCell(151, $tableCellStyle)->addText('Revisão:', $tableFontStyle);
                $table->addCell(151, $tableCellStyle)->addText('Última Alter:'.date('d/m/Y'), $tableFontStyle);

                return $section;

            break;
        }
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


    public function filterListDocuments($req) {
        $list = null;
        
        $date = \DateTime::createFromFormat('d/n/Y', $req['search_validadeDocumento']);
        $dateFmt = $date->format('Y-m-d');

        if(null == $req['search_tituloDocumento'] || "" == $req['search_tituloDocumento']) {
            $list = DB::table('documento')
                        ->join('dados_documento',   'dados_documento.documento_id', '=', 'documento.id')
                        ->join('workflow',          'workflow.documento_id',        '=', 'documento.id')
                        ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                            ->select('documento.*', 
                                'dados_documento.id AS dd_id', 'dados_documento.validade', 'dados_documento.versao',
                                'workflow.id AS wkf_id', 'workflow.etapa', 
                                'tipo_documento.id AS tp_doc_id', 'tipo_documento.nome_tipo'
                            )
                            ->where("documento.tipo_documento_id",             "=",    $req['search_tipoDocumento'])
                            ->where("dados_documento.aprovador_id",            "=",    $req['search_aprovador'])
                            ->where("dados_documento.grupo_treinamento_id",    "=",    $req['search_grupoTreinamento'])
                            ->where("dados_documento.grupo_divulgacao_id",     "=",    $req['search_grupoDivulgacao'])
                            ->where("dados_documento.validade",                "=",    $dateFmt)
                            ->get();
        } else {
            $list = DB::table('documento')
                        ->join('dados_documento',   'dados_documento.documento_id', '=', 'documento.id')
                        ->join('workflow',          'workflow.documento_id',        '=', 'documento.id')
                        ->join('tipo_documento',    'tipo_documento.id',            '=', 'documento.tipo_documento_id')
                            ->select('documento.*', 
                                'dados_documento.id AS dd_id', 'dados_documento.validade', 'dados_documento.versao',
                                'workflow.id AS wkf_id', 'workflow.etapa', 
                                'tipo_documento.id AS tp_doc_id', 'tipo_documento.nome_tipo'
                            )
                            ->where("documento.nome",  "ilike",   "%" . $req['search_tituloDocumento'] . "%")
                            ->get();
        }
        
        return $list;
    }

}
