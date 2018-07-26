<?php

namespace App\Http\Controllers\Formularios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DadosNovoFormularioRequest;
use App\GrupoDivulgacao;
use App\Setor;
use App\Documento;
use App\Formulario;
use App\TipoDocumento;
use Illuminate\Support\Facades\View;
use App\Configuracao;
use App\WorkflowFormulario;
use App\Classes\Constants;

class FormulariosController extends Controller
{
    
    public function index() {
        $gruposDivulgacao  = GrupoDivulgacao::orderBy('nome')->get()->pluck('nome', 'id');
        $setores           = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->orderBy('nome')->get()->pluck('nome', 'id');
        $documentos        = Documento::join('tipo_documento','tipo_documento.id','=', 'documento.tipo_documento_id')->get(['documento.id as doc_id', 'nome', 'nome_tipo', 'sigla'])->groupBy('nome_tipo')->toArray();
        $formularios       = Formulario::join('workflow_formulario', 'workflow_formulario.formulario_id', '=', 'formulario.id')->get();
        // dd($formularios);
        return view('formularios.index', ['formularios'=>$formularios, 'grupoDivulgacao' => $gruposDivulgacao, 'setores'=>$setores, 'documentosTipo'=>$documentos]);
    }
    
    public function validateData(DadosNovoFormularioRequest $request) {

        $text_setorDono       = Setor::where('id', '=', $request->setor_dono_form)->get(['nome']);
        $text_grupoDivulgacao = GrupoDivulgacao::where('id', '=', $request->grupoDivulgacao)->get(['nome']);
        $acao = $request->action;

        $nivelAcessoDocumento = (  ($request->nivelAcessoDocumento == 0) ? Constants::$NIVEL_ACESSO_DOC_LIVRE : ( ($request->nivelAcessoDocumento == 1) ? Constants::$NIVEL_ACESSO_DOC_RESTRITO : Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL  )    );

        $qtdForms = Formulario::count();

        $tipoDocumento = TipoDocumento::where('id', '=', Constants::$ID_TIPO_DOCUMENTO_FORMULARIO)->get(['nome_tipo', 'sigla']);
        $codigo_final = $tipoDocumento[0]->sigla;
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
        $novoForm = $request->all();

        // dd($novoForm);

        $formulario = new Formulario();
        $formulario->nome                 = $request->tituloFormulario;
        $formulario->codigo               = $request->codigoFormulario;
        $formulario->conteudo             = $request->formData;
        $formulario->setor_id             = $request->setor_dono_form;
        $formulario->grupo_divulgacao_id  = $request->grupoDivulgacao;
        $formulario->nivel_acesso         = $request->nivel_acesso;
        $formulario->save();

         // Quando tiver tempo, verificar se deu certo a inserção dos dados do documento
         $workflow = new WorkflowFormulario();
         $workflow->etapa_num    = Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
         $workflow->etapa        = Constants::$DESCRICAO_WORKFLOW_ANALISE_AREA_DE_QUALIDADE;
         $workflow->descricao    = "";
         $workflow->justificativa= "";
         $workflow->formulario_id = $formulario->id; // id que acabou de ser inserido no 'save' na tabela de formulário
         $workflow->save();

         return View::make('formularios.define-formulario', array('overlay_sucesso' => 'valor', 'docData'=>''));
    
    }

    public function viewForm(Request $request){        
        
        $formulario  = Formulario::where('id', '=', $request->fomulario_id)->get();
        
        return View::make('formularios.view-formulario', array(
            'nome'=>$formulario[0]->nome,  
            'document_id'=>$request->formulario_id, 
            'codigo'=>$formulario[0]->codigo, 
            'docData'=>$formulario[0]->conteudo, 
            'resp'=>false)
        );
    }

    public function saveEditForm(Request $request){
        dd($request);
        $document_id = $request->document_id;
        $documento = Formulario::find($document_id);
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

    }
}
