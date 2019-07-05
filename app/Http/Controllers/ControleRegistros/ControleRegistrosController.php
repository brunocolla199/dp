<?php

namespace App\Http\Controllers\ControleRegistros;

use App\Classes\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, Validator};
use App\{ControleRegistro, Setor};

class ControleRegistrosController extends Controller
{
    
    public function index() {
        $registros = $this->getRecordsByUser();
        return view('controle_registros.index', compact('registros'));
    }


    public function create() {
        $niveisAcesso = array(Constants::$NIVEL_ACESSO_DOC_LIVRE => Constants::$NIVEL_ACESSO_DOC_LIVRE, Constants::$NIVEL_ACESSO_DOC_RESTRITO => Constants::$NIVEL_ACESSO_DOC_RESTRITO);
        $setores      = $this->getSectorsByUser();

        return view('controle_registros.create', compact('setores', 'niveisAcesso'));
    }


    public function store(Request $request) {
        $continue = $this->makeValidator($request);
        if( !$continue ) {
            return redirect()->back()->withInput();
        } else {
        
            try {
                $registro = ControleRegistro::create($request->all());
            } catch (\Throwable $th) {
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

        return view('controle_registros.edit', compact('setores', 'niveisAcesso', 'registro'));
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
            $deleted = ControleRegistro::destroy($request->register_id);
            return response()->json(['response' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['response' => 'error']);
        }
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
            $records = ControleRegistro::with('setor')->where('setor_id', $idUserSector)->orderBy('codigo')->get();
        } else {
            $records = ControleRegistro::with('setor')->orderBy('codigo')->get();
        }

        return $records;
    }


    private function makeValidator(Request $request) {
        $validator = Validator::make($request->all(), [
            'codigo'                  => 'required|string|max:20',
            'titulo'                  => 'required|string|max:350',
            'setor_id'                => 'required|integer',
            'meio_distribuicao'       => 'required|string|max:150',
            'local_armazenamento'     => 'required|string|max:150',
            'protecao'                => 'required|string|max:150',
            'recuperacao'             => 'required|string|max:150',
            'nivel_acesso'            => 'required|string|max:20',
            'tempo_retencao_local'    => 'required|string|max:150',
            'tempo_retencao_deposito' => 'required|string|max:150',
            'disposicao'              => 'required|string|max:150'
        ]);

        if( $validator->fails() ) {
            $request->session()->flash('style', 'danger|close-circle');
            $request->session()->flash('message', $validator->messages()->first());
            return false;
        }

        return true;
    }

}
