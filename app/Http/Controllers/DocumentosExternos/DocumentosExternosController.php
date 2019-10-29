<?php

namespace App\Http\Controllers\DocumentosExternos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\{Constants, RESTGed, RESTServices};
use App\{DocumentoExterno, Setor};
use Illuminate\Support\Facades\{Auth, Validator};

class DocumentosExternosController extends Controller
{
    
    protected $ged;

    public function __construct() {
        $this->ged = new RESTGed( env('GED_URL'), env('GED_USER_ID'), env('GED_USER_TOKEN') );
    }


    public function index() 
    {
        $areas = collect($this->ged->getArea( env('GED_AREA_ID'), "true" ));
        $nonCreatedArea = false;
        $registers      = [];
        
        $areasBySector = $this->getAreasBySector($areas);
        if ($areasBySector->count() <= 0) $nonCreatedArea = true;
        
        if (!$nonCreatedArea) {
            $areasList = $areasBySector->keys()->toArray(); // The keys are the id of each area
            $registersList = $this->ged->getRegisters($areasList, [], array(
                'removido' => false,
                'inicio' => 0,
                'fim' => 100
            ));
            
            $objRegistersList = json_decode($registersList);
            $registersGed = collect($objRegistersList->listaRegistro)->groupBy('idArea');
        }

        $registers = array();

        foreach ($registersGed as $registerGed) {
            foreach ($registerGed as $value) {
                $files = $this->getDocumentsByRegister($value->id);
                foreach ($files as $file){
                    $arquivo['areaName'] = $areasBySector[$value->idArea];
                    $arquivo['file'] = $file;
                    array_push($registers, $arquivo);   
                }
            }
        }
        return view('documentos_externos.index', compact('areasBySector', 'registers', 'nonCreatedArea'));
    }


    public function store(Request $request) {
        $documentList   = array();
        $sectorName     = $request->sector_name;
        $databaseSector = Setor::where('nome', 'ILIKE', $sectorName)->first();
        $idAreaSector   = $request->id_area_sector;
        
        $validated = false;
        $userId    = null;
        if($request->i_approve == "true") {
            $validated = true;
            $userId    = Auth::user()->id;
        }

        $validator = Validator::make($request->all(), [
            'id_area_sector' => 'required|string|max:40'
        ]);

        if( $validator->fails() ) {
            return response()->json(['error' => 'Tivemos um problema ao salvar os arquivos. Por favor, contate o suporte.']);
        } else if( is_null($databaseSector) ) {
            return response()->json(['error' => 'O nome da área para armazenar os documentos deve ser igual ao nome do setor escolhido. Por favor, peça ao suporte para criá-la.']);
        }


        // Cria o registro de documento externo e salva o arquivo no GED
        $externalDocuments = $request->file('file');
        foreach ($externalDocuments as $document) {
            array_push($documentList, [
                'endereco'  => $document->getClientOriginalName(),
                'idUsuario' => $this->ged->getUSERID(),
                'bytes'     => base64_encode(file_get_contents($document))
            ]);
        }

        $registerId   = $this->ged->createRegister($idAreaSector, $this->ged->getUSERID(), [], $documentList);
        $fullRegister = $this->ged->getRegister($registerId);
        
        foreach ($fullRegister->listaDocumento as $key => $document) {
            DocumentoExterno::create([
                'id_documento'          => $document->id,
                'id_registro'           => $registerId, 
                'id_area'               => $idAreaSector, 
                'validado'              => $validated, 
                'responsavel_upload_id' => Auth::user()->id, 
                'user_id'               => $userId, 
                'setor_id'              => $databaseSector->id
            ]);
        }

        
        return response()->json(['success' => 'Seus arquivos foram salvos com sucesso.']);
    }


    public function getDocumentsByRegister(string $registerId)
    {   

            $register = $this->ged->getRegister($registerId, 'true', 'false');
            
            return $register->listaDocumento;
   
    }


    public function accessDocument(string $documentId) {
        $document          = $this->ged->getDocument($documentId);
        $dbDocument        = DocumentoExterno::where('id_documento', $document->id)->first();
        $validated         = $dbDocument->validado;
        $approver          = 'Não possui';
        $responsibleUpload = $dbDocument->responsavelUpload;

        if( $validated ) $approver = $dbDocument->aprovador;

        return view('documentos_externos.access', [
            'document'          => $document,
            'dbDocumentId'      => $dbDocument->id,
            'filename'          => $document->listaIndice[0]->valor,
            'validated'         => $validated,
            'approver'          => $approver,
            'responsibleUpload' => $responsibleUpload,
        ]);
    }


    public function delete(Request $request) {
        $documentId = $request->document_id;

        $dbDocument = DocumentoExterno::where('id_documento', $documentId)->first();
        $registerId = $dbDocument->id_registro;

        $statusCode = $this->ged->removeDocument($documentId);
        if( $statusCode == 200 ) {
            $dbDocument->delete();

            // Caso não existam mais docs nesse registro, o próprio registro é excluído para evitar "registros fantasmas"
            $registryDocuments = DocumentoExterno::where('id_registro', $registerId)->get();
            if( $registryDocuments->count() <= 0 ) {
                $registerStatusCode = $this->ged->removeRegister($registerId);
            }

            $request->session()->put('removed-doc-success', 'Documento excluído com sucesso!');
            return response()->json(['response' => 'success']);
        } else {
            return response()->json(['response' => 'error']);
        }
    }


    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'document_updated' => 'required|file|mimes:pdf'
        ]);

        if( $validator->fails() ) {
            $request->session()->flash('style', 'danger|close-circle');
            $request->session()->flash('message', 'É obrigatório que você insira um arquivo e que ele seja em formato .pdf. Por favor, revise o campo do arquivo!');
            return redirect()->back()->withInput();
        }
        
        // Como o documento para ser atualizado já foi pesquisado anteriormente, a view já contém as informações necessárias para atualizá-lo
        $documentUpdated = $request->file('document_updated');
        
        $properties = [
            'id'         => $request->document_id,
            'idRegistro' => $request->register_id,
            'idArea'     => $request->area_id,
            'idUsuario'  => $this->ged->getUSERID(),
            'bytes'      => base64_encode(file_get_contents($documentUpdated)),
            'endereco'   => $documentUpdated->getClientOriginalName(),
            'removido'   => false,
        ];
        
        $finalDocument = $this->ged->updateDocument($properties);
        if( isset($finalDocument->id) ) {
            $dbDocument                        = DocumentoExterno::where('id', $request->db_document_id)->where('id_documento', $request->document_id)->first();
            $dbDocument->validado              = false;
            $dbDocument->responsavel_upload_id = Auth::user()->id;
            $dbDocument->save();

            $request->session()->flash('style', 'success|check-circle');
            $request->session()->flash('message', 'Documento atualizado com sucesso!');
            return redirect()->back()->withInput();
        } else {
            $request->session()->flash('style', 'danger|close-circle');
            $request->session()->flash('message', 'Ops, tivemos um problema ao atualizar o documento. Por favor, contate o suporte técnico!');
            return redirect()->back()->withInput();
        }
    }


    public function approval(Request $request) {
        $dbDocument = DocumentoExterno::where('id', $request->db_document_id)->where('id_documento', $request->document_id)->first();
        
        $dbDocument->validado = true;
        $dbDocument->user_id  = Auth::user()->id;
        $dbDocument->save();

        $request->session()->flash('style', 'success|check-circle');
        $request->session()->flash('message', 'Documento validado com sucesso!');
        return redirect()->back()->withInput();
    }


    public function getBytes(Request $request) {
        $document = $this->ged->getDocument($request->document_id, 'true');
        return response()->json(['response' => $document->bytes]);
    }



    // Private methods
    private function getAreasBySector($areas) {

        $userSectorId = Auth::user()->setor_id;
        if( $userSectorId != Constants::$ID_SETOR_QUALIDADE ) {
            $userSector = Setor::find($userSectorId);

            $areasBySector = $areas->filter(function($area, $key) use ($userSector) {
                return strtolower($userSector->nome) ==  strtolower($area->nome);
            });

            if( $areasBySector->count() > 0) {                 
                $areasBySector = $areasBySector->pluck('nome', 'id');
                $areasBySector = $areasBySector->forget(env('GED_AREA_ID'));
            }
        } else {
            $areasBySector = $areas->pluck('nome', 'id');
            $areasBySector = $areasBySector->forget(env('GED_AREA_ID'));
        }

        return $areasBySector;
    }

}
