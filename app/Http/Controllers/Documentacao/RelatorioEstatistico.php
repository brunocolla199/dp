<?php

namespace App\Http\Controllers\Documentacao;

use Carbon\Carbon;
use App\Classes\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\{Arr, Str};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use App\{Documento, HistoricoDocumento, TipoDocumento};

class RelatorioEstatistico extends Controller
{
    
    protected $docTypes;
    protected $totalOverdue;
    protected $totalRevised;

    // TODO: posso criar 2 propriedades aqui: total de docs revisados e expirados e já preenchê-las enquanto encontro eles

    function __construct() {
        $this->docTypes     = TipoDocumento::where('id', '<=', '3')->orderBy('nome_tipo')->get()->pluck('nome_tipo', 'id')->toArray();
        $this->totalOverdue = 0;
        $this->totalRevised = 0;
    }


    public function index() {
        return view('documentacao.index-statical-report', ['tipoDocumentos' => $this->docTypes]);
    }


    public function makeReport(Request $request) {
        $dateArr   = explode(' - ', $request->daterange);
        $startDate = $dateArr[0];
        $endDate   = $dateArr[1];

        $validator = Validator::make($request->all(), [
            'daterange' => 'required',
            'tipo_documento' => 'required',
        ]);

        if( $validator->fails() ) {
            return back()->withErrors(['message' => $validator->messages()->first()]);
        }

        // Não existe nenhuma verificação inicial pois essa opção está liberada apenas para o setor Processos, ou seja, somente para os administradores do sistema
        $docTypeId = ( $request->tipo_documento == "todos" ) ? 99 : (int) $request->tipo_documento;
        $docs      = $this->getDocuments(Carbon::createFromFormat('d/m/Y', $startDate), Carbon::createFromFormat('d/m/Y', $endDate), $docTypeId);

        $expiredDocs = $this->getExpiredDocsBySector($docs);
        $revisedDocs = $this->getRevisedDocsBySector($docs);

        
        // Prepara os dados para serem exibidos na view
        $sectorsContainExpired = $expiredDocs->keys();
        $sectorsContainRevised = $revisedDocs->keys();
        $sectors               = $sectorsContainExpired->merge($sectorsContainRevised)->unique();
        
        $docsBySector = $sectors->map(function($sectorName, $key) use($expiredDocs, $revisedDocs) {
            return array(
                'expired'    => ( Arr::has($expiredDocs, $sectorName) ) ? $expiredDocs[$sectorName]->count() : 0,
                'revised'    => ( Arr::has($revisedDocs, $sectorName) ) ? $revisedDocs[$sectorName]->count() : 0,
                'sectorName' => Str::limit($sectorName, 7),
            );
        });

        $listDocsBySector = $sectors->map(function($sectorName, $key) use($expiredDocs, $revisedDocs) {
            return array(
                'expired'    => ( Arr::has($expiredDocs, $sectorName) ) ? $expiredDocs[$sectorName] : [],
                'revised'    => ( Arr::has($revisedDocs, $sectorName) ) ? $revisedDocs[$sectorName] : [],
                'sectorName' => $sectorName,
                'identifier' => str_replace(' ', '_', $sectorName),
            );
        });

        
        return view('documentacao.view-statical-report', [
            'tipoDocumentos' => $this->docTypes, 
            'periodo' => $request->daterange,
            'totalPendentesRevisao' => $this->totalOverdue,
            'totalRevisados' => $this->totalRevised,
            'documentosPorSetor' => $docsBySector,
            'listaDocumentosPorSetor' => $listDocsBySector
        ]);
    }


    private function getDocuments(Carbon $_startDate, Carbon $_endDate, int $_docTypeId) {
        
        if( $_docTypeId == 99 ) { // Todos

            $documents = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')
                                    ->join('setor', 'setor.id', '=', 'dados_documento.setor_id')
                                    ->where('dados_documento.validade', '>', $_startDate->format('Y-m-d'))->where('dados_documento.validade', '<', $_endDate->format('Y-m-d'))
                                    ->select('documento.id', 'documento.nome', 'documento.codigo', 'dados_documento.validade', 'dados_documento.revisao', 'setor.nome AS sNome')->get();
        } else {

            $documents = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')
                                    ->join('setor', 'setor.id', '=', 'dados_documento.setor_id')
                                    ->where('dados_documento.validade', '>', $_startDate->format('Y-m-d'))->where('dados_documento.validade', '<', $_endDate->format('Y-m-d'))
                                    ->where('documento.tipo_documento_id', $_docTypeId)
                                    ->select('documento.id', 'documento.nome', 'documento.codigo', 'dados_documento.validade', 'dados_documento.revisao', 'setor.nome AS sNome')->get();
        }
                            
        return $documents;
    }


    private function getExpiredDocsBySector(Collection $_docs) {        
        
        $filteredDocuments = $_docs->filter(function($v, $k) {
            return $v->validade < Carbon::now()->format('Y-m-d');
        });

        $this->totalOverdue = $filteredDocuments->count();
        $groupedDocuments   = $filteredDocuments->groupBy('sNome');

        return $groupedDocuments;
    }


    private function getRevisedDocsBySector(Collection $_docs) {

        $docsWithRevisions = $_docs->filter(function ($item, $key) {
            $docHistory = HistoricoDocumento::where('documento_id', $item->id)->where('descricao', Constants::$DESCRICAO_WORKFLOW_DOCUMENTO_DIVULGADO)->get();
            if($docHistory->count() > 0) {

                $visualRevisions = array();
                $currentRevision = (int) $item->revisao;
                $firstRevision   = $currentRevision - $docHistory->count() + 1;
                foreach( range($firstRevision, $currentRevision) as $revisionNumber ) {
                    $revisionNumber = ($revisionNumber < 10) ? "0{$revisionNumber}" : $revisionNumber;
                    $visualRevisions[] = $item->codigo . ' - Revisão ' . $revisionNumber;
                }

                $item['revisions_number'] = $docHistory->count();
                $item['revisions']        = $visualRevisions;

                return $item;
            }

            return false;
        });

        $this->totalRevised = $docsWithRevisions->count();
        $groupedDocuments   = $docsWithRevisions->groupBy('sNome');
        
        return $groupedDocuments;
    }

}
