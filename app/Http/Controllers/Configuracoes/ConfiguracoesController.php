<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setor;
use App\Configuracao;
use App\GrupoTreinamento;
use App\GrupoDivulgacao;
use App\Classes\Constants;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NumberDefaultRequest;
use App\Http\Requests\NewGroupingRequest;
use App\Http\Requests\EditSectorRequest;
use Illuminate\Support\Facades\View;

class ConfiguracoesController extends Controller
{
    
    public function index() {
        $setoresEmpresa = DB::table('setor')
                            ->join('tipo_setor', 'tipo_setor.id', '=', 'setor.tipo_setor_id')
                            ->select('setor.*', 'tipo_setor.nome AS nome_tipo')
                            ->where('setor.tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)
                            ->orderBy('nome')
                            ->get();

        $gruposTreinamento = DB::table('grupo_treinamento')
                                ->select('grupo_treinamento.*')
                                ->orderBy('nome')
                                ->get();

        $gruposDivulgacao  = DB::table('grupo_divulgacao')
                                ->select('grupo_divulgacao.*')
                                ->orderBy('nome')
                                ->get();

        $numeroPadraoParaCodigo = Configuracao::all();

        return view('configuracoes.index', ['setoresEmpresa' => $setoresEmpresa, 'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao,
                                            'numeroPadraoParaCodigo' => $numeroPadraoParaCodigo[0]->numero_padrao_codigo]);
    }


    public function saveNumberDefault(NumberDefaultRequest $request) {
        $c = "0";

        if( strlen($request->numeroPadrao) < 4 ) {
            if( strlen($request->numeroPadrao) == 1 ) $c = "0";
            else if( strlen($request->numeroPadrao) == 2)  $c = "00";
            else $c = "000";
        } else {
            $c = "000.";
        }
        
        $config = Configuracao::where('id', '=', 1)->get();
        $config[0]->numero_padrao_codigo = $c;
        $config[0]->save();

        return redirect()->route('configuracoes')->with(['padrao_sucesso' => 'valor']);
    }


    public function saveNewGrouping(NewGroupingRequest $request) {
        $nome_agrupamento   = $request->nome_do_agrupamento;
        $desc_agrupamento   = $request->descrição;
        $tipo_insercao      = $request->tipo_do_agrupamento;
        switch($tipo_insercao) {
            case Constants::$ID_TIPO_AGRUPAMENTO_SETOR:
                $setor = new Setor();
                $setor->nome            = $nome_agrupamento;
                $setor->descricao       = $desc_agrupamento;
                $setor->sigla           = (strlen($nome_agrupamento) >= 3) ? strtoupper(substr($nome_agrupamento, 0, 3)) : "SIGLA";
                $setor->tipo_setor_id   = Constants::$ID_TIPO_SETOR_SETOR_NORMAL;
                $setor->save();
                break;
            case Constants::$ID_TIPO_AGRUPAMENTO_GRUPO_TREINAMENTO:
                $gTreinamento = new GrupoTreinamento();
                $gTreinamento->nome        = $nome_agrupamento;
                $gTreinamento->descricao   = $desc_agrupamento;
                $gTreinamento->save();
                break;
            default:
                $gDivulgacao = new GrupoDivulgacao();
                $gDivulgacao->nome        = $nome_agrupamento;
                $gDivulgacao->descricao   = $desc_agrupamento;
                $gDivulgacao->save();
                break;
        }

        return redirect()->route('configuracoes')->with(['new_grouping_sucesso' => 'valor']);
    }


    public function editSector(EditSectorRequest $request) {
        $setor = Setor::where('id', '=', $request->id_do_setor)->get();
        $setor[0]->nome = $request->nome_do_setor;
        $setor[0]->sigla = $request->sigla_do_setor;
        $setor[0]->descricao = $request->descrição_do_setor;
        $setor[0]->save();

        return redirect()->route('configuracoes')->with(['edit_sector_success' => 'valor']);
    }


    public function editTrainingGroup(Request $request) {
        $grupoT = GrupoTreinamento::where('id', '=', $request->id_do_grupo_de_treinamento)->get();
        $grupoT[0]->nome = $request->nome_do_grupo_de_treinamento;
        $grupoT[0]->descricao = $request->descrição_do_grupo_de_treinamento;
        $grupoT[0]->save();

        return redirect()->route('configuracoes')->with(['edit_training-group_success' => 'valor']);
    }


    public function editDisclosureGroup(Request $request) {
        $grupoD = GrupoDivulgacao::where('id', '=', $request->id_do_grupo_de_divulgação)->get();
        $grupoD[0]->nome = $request->nome_do_grupo_de_divulgação;
        $grupoD[0]->descricao = $request->descrição_do_grupo_de_divulgação;
        $grupoD[0]->save();

        return redirect()->route('configuracoes')->with(['edit_disclosure-group_success' => 'valor']);
    }

}
