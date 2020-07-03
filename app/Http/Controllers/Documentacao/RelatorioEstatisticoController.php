<?php

namespace App\Http\Controllers\Documentacao;

use Carbon\Carbon;
use App\Classes\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\{Arr, Str};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Validator, Auth};
use Illuminate\Database\Eloquent\Collection;
use App\{Documento, HistoricoDocumento, TipoDocumento, Setor};

class RelatorioEstatisticoController extends Controller
{
    
    protected $docTypes;
    protected $totalOverdue;
    protected $totalRevised;

    public function __construct()
    {
        $this->totalOverdue = 0;
        $this->totalRevised = 0;
        $this->docTypes = TipoDocumento::where('id', '<=', '3')->orderBy('nome_tipo')->get()->pluck(
            'nome_tipo',
            'id'
        )->toArray();
    }
    
    
    public function index()
    {
        $setores = Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE ?
        Setor::all()->toArray() :
        Setor::where('id', Auth::user()->setor_id)->get()->toArray();

        return view('documentacao.index-statical-report', ['tipoDocumentos' => $this->docTypes, 'setores' => $setores]);
    }


    public function makeReport(Request $request)
    {
        $dateArr   = explode(' - ', $request->daterange);
        $startDate = $dateArr[0];
        $endDate   = $dateArr[1];

        $validator = Validator::make($request->all(), [
            'daterange' => 'required',
            'tipo_documento' => 'required',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors(['message' => $validator->messages()->first()]);
        }

        // Não existe nenhuma verificação inicial (opção está liberada apenas para o setor Processos)
        $docTypeId = ( $request->tipo_documento == "todos" ) ? 99 : (int) $request->tipo_documento;
    
        $setores = Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE ?
        Setor::all() :
        Setor::where('id', Auth::user()->setor_id)->get();

        $docs = $this->getDocuments($docTypeId, $request->setores ?? $setores->pluck('id')->toArray());

        $expiredDocs = $this->getExpiredDocsBySector($docs);
        $revisedDocs = $this->getRevisedDocsBySector(
            $docs,
            Carbon::createFromFormat('d/m/Y', $startDate)->startOfDay(),
            Carbon::createFromFormat('d/m/Y', $endDate)->endOfDay()
        );


        // Prepara os dados para serem exibidos na view
        $sectorsContainExpired = $expiredDocs->keys();
        $sectorsContainRevised = $revisedDocs->keys();
        $allSectors = $sectorsContainExpired->merge($sectorsContainRevised)->unique();
        $chartist = [];

        $chartist['sectors'] = $allSectors->toArray();

        foreach ($allSectors->toArray() as $sectorName) {
            $chartist['revised'][] = (Arr::has($revisedDocs, $sectorName)) ? $revisedDocs[$sectorName]->count() : 0;
            $chartist['expired'][] = (Arr::has($expiredDocs, $sectorName)) ? $expiredDocs[$sectorName]->count() : 0;
        }

        $listDocsBySector = $allSectors->map(function ($sectorName) use ($expiredDocs, $revisedDocs) {
            return array(
                'expired'    => (Arr::has($expiredDocs, $sectorName)) ? $expiredDocs[$sectorName] : [],
                'revised'    => (Arr::has($revisedDocs, $sectorName)) ? $revisedDocs[$sectorName] : [],
                'sectorName' => $sectorName,
                'identifier' => str_replace(' ', '_', $sectorName),
            );
        });

        return view('documentacao.view-statical-report', [
            'tipoDocumentos' => $this->docTypes,
            'periodo' => $request->daterange,
            'totalPendentesRevisao' => $this->totalOverdue,
            'totalRevisados' => $this->totalRevised,
            'chartist' => $chartist,
            'listaDocumentosPorSetor' => $listDocsBySector,
            'setores' => $setores->toArray(),
            'setoresSelected' => $request->setores
        ]);
    }


    /**
     * Método que busca TODOS documentos, com as propriedades necessárias, para depois filtrar conforme a necessidade.
     *
     * @param Carbon $_startDate
     * @param Carbon $_endDate
     * @param int $_docTypeId
     *
     * @return Collection
     */
    private function getDocuments(int $_docTypeId, array $_sectors)
    {
        if ($_docTypeId == 99) { // Todos
            $documents = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')
                                    ->join('setor', 'setor.id', '=', 'dados_documento.setor_id')
                                    ->select('documento.id', 'documento.nome', 'documento.codigo', 'dados_documento.validade', 'dados_documento.revisao', 'setor.nome AS sNome', 'setor.sigla AS sSigla')
                                    ->whereIn('setor.id', $_sectors)
                                    ->where('dados_documento.obsoleto', false)
                                    ->orderBy('setor.nome')->get();
        } else {
            $documents = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')
                                    ->join('setor', 'setor.id', '=', 'dados_documento.setor_id')
                                    ->where('documento.tipo_documento_id', $_docTypeId)
                                    ->select('documento.id', 'documento.nome', 'documento.codigo', 'dados_documento.validade', 'dados_documento.revisao', 'setor.nome AS sNome', 'setor.sigla AS sSigla')
                                    ->whereIn('setor.id', $_sectors)
                                    ->where('dados_documento.obsoleto', false)
                                    ->orderBy('setor.nome')->get();
        }
                            
        return $documents;
    }


    /**
     * Captura todos os documentos VENCIDOS (data de validade MENOR do que hoje),
     *  agrupa todos, chaveando pelo nome do setor dono do documento e retorna como uma Collection.
     *
     * @param Collection $_docs
     *
     * @return Collection
     */
    private function getExpiredDocsBySector(Collection $_docs)
    {
        $filteredDocuments = $_docs->filter(function ($v, $k) {
            return $v->validade < Carbon::now()->format('Y-m-d');
        });

        $this->totalOverdue = $filteredDocuments->count();
        $groupedDocuments = $filteredDocuments->groupBy('sSigla');

        return $groupedDocuments;
    }


    /**
     * Encontra todos os históricos gravados quando um documento é divulgado (encerramento do processo),
     *  contabiliza quantas vezes isso ocorreu e exibe o número da revisão executada.
     *
     * @param Collection $_docs
     * @param Carbon $_startDate
     * @param Carbon $_endDate
     *
     * @return Collection
     */
    private function getRevisedDocsBySector(Collection $_docs, Carbon $_startDate, Carbon $_endDate)
    {
        $docsWithRevisions = $_docs->filter(function ($item) use ($_startDate, $_endDate) {
            $docHistory = HistoricoDocumento::where('documento_id', $item->id)->where(
                'descricao',
                Constants::$DESCRICAO_WORKFLOW_EM_REVISAO
            )->get();
            if ($docHistory->count() > 0) {
                $visualRevisions = array();
                $currentRevision = (int) $item->revisao;
                $revisionsNumber = 0;
                $counter = $docHistory->count();

                while ($counter > 0) {
                    $reviewedAt = $docHistory[$counter - 1]->created_at;
                    if ($reviewedAt->between($_startDate, $_endDate)) {
                        $revision = ($currentRevision < 10) ? "0{$currentRevision}" : $currentRevision;
                        $visualRevisions[] = $item->codigo . ' - Revisão ' . $revision;
                        $revisionsNumber++;
                    }

                    $counter--;
                    $currentRevision--;
                }
                if ($revisionsNumber) {
                    $item['revisions_number'] = $revisionsNumber;
                    $item['revisions'] = $visualRevisions;
                    return $item;
                }
                return false;
            }
            return false;
        });

        $this->totalRevised = $docsWithRevisions->count();
        $groupedDocuments = $docsWithRevisions->groupBy('sSigla');
        
        return $groupedDocuments;
    }
}
