<?php

namespace App\Http\Controllers\ControleRegistros;

use App\Classes\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, Log, Validator};
use App\{ControleRegistro, OpcoesControleRegistros, Setor};

class ControleRegistrosController extends Controller
{
    
    public function index() {
        $registros = $this->getRecordsByUser();
        return view('controle_registros.index', compact('registros'));
    }


    public function create() {
        $niveisAcesso = array(Constants::$NIVEL_ACESSO_DOC_LIVRE => Constants::$NIVEL_ACESSO_DOC_LIVRE, Constants::$NIVEL_ACESSO_DOC_RESTRITO => Constants::$NIVEL_ACESSO_DOC_RESTRITO);
        $setores      = $this->getSectorsByUser();

        $locaisArmazenamento = $this->getOption('LOCAL_ARMAZENAMENTO');
        $disposicao          = $this->getOption('DISPOSICAO');
        $meiosDistribuicao   = $this->getOption('MEIO_DISTRIBUICAO');
        $protecao            = $this->getOption('PROTECAO');
        $recuperacao         = $this->getOption('RECUPERACAO');
        $tempoRetDeposito    = $this->getOption('TEMPO_RETENCAO_DEPOSITO');
        $tempoRetLocal       = $this->getOption('TEMPO_RETENCAO_LOCAL');

        return view('controle_registros.create', compact('setores', 'niveisAcesso', 'locaisArmazenamento', 'disposicao', 'meiosDistribuicao', 'protecao', 'recuperacao', 'tempoRetDeposito', 'tempoRetLocal'));
    }


    public function store(Request $request) {
        $continue = $this->makeValidator($request);
        if( !$continue ) {
            return redirect()->back()->withInput();
        } else {
        
            try {
                $registro = ControleRegistro::create($request->all());
            } catch (\Throwable $th) {
                Log::error($th->errorInfo);
                $request->session()->flash('style', 'danger|close-circle');
                $request->session()->flash('message', 'Ops, tivemos um problema ao criar o novo registro. Por favor, contate o suporte técnico!');
                return redirect()->back()->withInput();
            }

            $request->session()->flash('style', 'success|check-circle');
            $request->session()->flash('message', 'Novo registro criado com sucesso!');    
            return redirect()->route('controle-registros');
        }
    }


    public function edit(ControleRegistro $registro) {
        $niveisAcesso = array(Constants::$NIVEL_ACESSO_DOC_LIVRE => Constants::$NIVEL_ACESSO_DOC_LIVRE, Constants::$NIVEL_ACESSO_DOC_RESTRITO => Constants::$NIVEL_ACESSO_DOC_RESTRITO);
        $setores      = $this->getSectorsByUser();

        $locaisArmazenamento = $this->getOption('LOCAL_ARMAZENAMENTO');
        $disposicao          = $this->getOption('DISPOSICAO');
        $meiosDistribuicao   = $this->getOption('MEIO_DISTRIBUICAO');
        $protecao            = $this->getOption('PROTECAO');
        $recuperacao         = $this->getOption('RECUPERACAO');
        $tempoRetDeposito    = $this->getOption('TEMPO_RETENCAO_DEPOSITO');
        $tempoRetLocal       = $this->getOption('TEMPO_RETENCAO_LOCAL');

        return view('controle_registros.edit', compact('setores', 'niveisAcesso', 'registro', 'locaisArmazenamento', 'disposicao', 'meiosDistribuicao', 'protecao', 'recuperacao', 'tempoRetDeposito', 'tempoRetLocal'));
    }


    public function update(Request $request) {
        $continue = $this->makeValidator($request);
        if( !$continue ) {
            return redirect()->back()->withInput();
        } else {

            try {
                $registro = ControleRegistro::findOrFail($request->id_registro);
                $registro->update($request->all());
            } catch (\Throwable $e) {
                $request->session()->flash('style', 'danger|close-circle');
                $request->session()->flash('message', 'Não altere as informações do formulário!');
                return redirect()->back()->withInput();
            }
            
            $request->session()->flash('style', 'success|check-circle');
            $request->session()->flash('message', 'Registro atualizado com sucesso!');    
            return redirect()->route('controle-registros');
        }
    }


    public function delete(Request $request) {
        try {
            $deleted = ControleRegistro::destroy($request->_id);
            return response()->json(['response' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['response' => 'error']);
        }
    }


    public function indexOptions() {
        $fields     = Constants::$CONTROLE_REGISTROS;
        $firstField = array_keys($fields)[0];
        
        $options = OpcoesControleRegistros::where('campo', $firstField)->orderBy('descricao')->get();
        return view('controle_registros.index-options', compact('options'));
    }


    public function createOption() {
        return view('controle_registros.create-option');
    }


    public function storeOption(Request $request) {
        $validator = Validator::make($request->all(), [
            'campo'     => 'required|string',
            'descricao' => 'required|string',
            'ativo'     => 'string|max:3',
        ]);

        if( $validator->fails() ) {
            $request->session()->flash('style', 'danger|close-circle');
            $request->session()->flash('message', $validator->messages()->first());
            return redirect()->back()->withInput();
        }
        
        OpcoesControleRegistros::create(['campo' => $request->campo, 'descricao' => $request->descricao, 'ativo' => $request->ativo ? true : false]);
        $request->session()->flash('style', 'success|check-circle');
        $request->session()->flash('message', "Opção '$request->descricao' criada com sucesso!");

        return redirect()->route('controle-registros.index-options');
    }


    public function filterOptions(Request $request) {
        $options = OpcoesControleRegistros::where('campo', $request->campo)->orderBy('descricao')->get();
        return view('controle_registros.index-options', compact('options'));
    }


    public function deleteOption(Request $request) {
        $response = 'success';
        $code     = '';
        $option   = OpcoesControleRegistros::find($request->_id);

        try {
            $option->delete();
        } catch (\Throwable $th) {
            $response = 'error';
            $code     = $th->errorInfo[0];
        }

        return response()->json(['response' => $response, 'code' => $code]);
    }


    public function editOption(OpcoesControleRegistros $option) {
        return view('controle_registros.edit-option', compact('option'));
    }


    public function updateOption(Request $request) {
        $request['ativo'] = array_key_exists('ativo', $request->all()) ? true : false;
        $option = OpcoesControleRegistros::find($request->optionId)->update($request->all());
        
        $request->session()->flash('style', 'success|check-circle');
        $request->session()->flash('message', "Opção '$request->descricao' atualizada com sucesso!");
        return redirect()->route('controle-registros.index-options');
    }




    private function getSectorsByUser() {
        $idUserSector = Auth::user()->setor_id;
        if( $idUserSector != Constants::$ID_SETOR_QUALIDADE ) {
            $setores = Setor::find($idUserSector);
        } else {
            $setores = Setor::where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->orderBy('nome')->get();
        }
        $setores = $setores->pluck('nome', 'id')->toArray();

        return $setores;
    }


    private function getRecordsByUser() {
        $idUserSector = Auth::user()->setor_id;
        if( $idUserSector != Constants::$ID_SETOR_QUALIDADE ) {
            $records = ControleRegistro::with('setor')->where('setor_id', $idUserSector)->where('ativo', true)->orderBy('codigo')->get();
        } else {
            $records = ControleRegistro::with('setor')->where('ativo', true)->orderBy('codigo')->get();
        }

        return $records;
    }


    private function makeValidator(Request $request) {
        $validator = Validator::make($request->all(), [
            'codigo'                     => 'required|string|max:20',
            'titulo'                     => 'required|string|max:350',
            'setor_id'                   => 'required|integer',
            'meio_distribuicao_id'       => 'required|integer',
            'local_armazenamento_id'     => 'required|integer',
            'protecao_id'                => 'required|integer',
            'recuperacao_id'             => 'required|integer',
            'nivel_acesso'               => 'required|string|max:20',
            'tempo_retencao_local_id'    => 'required|integer',
            'tempo_retencao_deposito_id' => 'required|integer',
            'disposicao_id'              => 'required|integer'
        ]);

        if( $validator->fails() ) {
            $request->session()->flash('style', 'danger|close-circle');
            $request->session()->flash('message', $validator->messages()->first());
            return false;
        }

        return true;
    }


    private function getOption($_key) {
        return OpcoesControleRegistros::where('campo', $_key)->where('ativo', true)->orderBy('descricao')->get()->pluck('descricao', 'id');
    }

}
