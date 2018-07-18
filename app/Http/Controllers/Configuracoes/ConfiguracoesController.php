<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setor;
use App\Configuracao;
use App\GrupoTreinamento;
use App\GrupoTreinamentoUsuario;
use App\GrupoDivulgacao;
use App\User;
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

        $diretoriaGerencia = DB::table('setor')
                                ->select('setor.*')
                                ->where('id', '=', Constants::$ID_TIPO_SETOR_DIRETORIA)
                                ->orWhere('id', '=', Constants::$ID_TIPO_SETOR_GERENCIA)
                                ->orderBy('nome')
                                ->get();

        $numeroPadraoParaCodigo = Configuracao::all();

        return view('configuracoes.index', ['setoresEmpresa' => $setoresEmpresa, 'gruposTreinamento' => $gruposTreinamento, 'gruposDivulgacao' => $gruposDivulgacao,
                                            'diretoriaGerencia' => $diretoriaGerencia, 'numeroPadraoParaCodigo' => $numeroPadraoParaCodigo[0]->numero_padrao_codigo]);
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


    public function linkUsersTrainingGroup($id) {
        // $gruposTreinamentoEUsuarios = [];
        
        // $gruposT = GrupoTreinamento::all();
        // foreach($gruposT as $key => $grupo) {
        //     $arrUsers = [];
        //     $relations = GrupoTreinamentoUsuario::where('grupo_id', '=', $grupo->id)->get();
        //     foreach($relations as $key2 => $rel) {
        //         $user = User::where('id', '=', $rel->usuario_id)->get();
        //         $arrUsers[] = $user->name;
        //     }
        //     $gruposTreinamentoEUsuarios[$grupo->nome] = $arrUsers;
        // }

        $usersAndSectors = [];
        $grupoAtual      = [];

        $allSectors = Setor::orderBy('nome')->get();
        foreach($allSectors as $key => $sector) {
            $arrUsers = [];
            $users = User::where('setor_id', '=', $sector->id)->get();
            foreach($users as $key2 => $user) {
                $arrUsers[$user->id] = $user->name;
            }
            $usersAndSectors[$sector->nome] = $arrUsers;
        }


        $arrUsers = [];
        $grupoT = GrupoTreinamento::where('id', '=', $id)->get();
        $relations = GrupoTreinamentoUsuario::where('grupo_id', '=', $grupoT[0]->id)->get();
        foreach($relations as $key => $rel) {
            $user = User::where('id', '=', $rel->usuario_id)->get();
            $arrUsers[] = $user[0]->name;
        }
        $grupoAtual[$grupoT[0]->nome] = $arrUsers;        

        $grupoTreinamento = GrupoTreinamento::where('id', '=', $id)->get();
        $text_agrupamento = "ao setor " . $grupoTreinamento[0]->nome;
        $checkGrouping = $grupoTreinamento[0]->nome;

        return view('configuracoes.link-users', ['text_agrupamento' => $text_agrupamento, 'checkGrouping' => $checkGrouping, 'grupoT' => $grupoTreinamento[0], 'setoresUsuarios' => $usersAndSectors, 'usuariosJaVinculados' => $grupoAtual]);
    }


    public function linkUsersDirectionManagement($id) {
        $usersAndSectors = [];

        $allSectors = Setor::orderBy('nome')->get();
        foreach($allSectors as $key => $sector) {
            $arrUsers = [];
            $users = User::where('setor_id', '=', $sector->id)->get();
            foreach($users as $key2 => $user) {
                $arrUsers[$user->id] = $user->name;
            }
            $usersAndSectors[$sector->nome] = $arrUsers;
        }
        

        $setorAtual = Setor::where('id', '=', $id)->get();
        $text_agrupamento = ($id == Constants::$ID_TIPO_SETOR_DIRETORIA) ? "à Diretoria" : "à Gerência";
        $checkGrouping = ($id == Constants::$ID_TIPO_SETOR_DIRETORIA) ? "Diretoria" : "Gerência";

        return view('configuracoes.link-users', ['text_agrupamento' => $text_agrupamento, 'checkGrouping' => $checkGrouping, 'setor' => $setorAtual[0], 'setoresUsuarios' => $usersAndSectors]);
    }


    public function linkSave(Request $request) {
        // dd($request->all());
        $novosUsuariosVinculados = $request->usersLinked;

        $tipoAgrupamento = $request->tipo_agrupamento;
        $idAgrupamento   = $request->id_agrupamento;

        switch ($tipoAgrupamento) {
            case '1': // Grupo de Treinamento
                foreach($novosUsuariosVinculados as $key => $user) {
                    $relations = DB::table('grupo_treinamento_usuario')->where([
                        ['grupo_id', '=', $idAgrupamento],
                        ['usuario_id', '=', $user]
                    ])->get();
                    
                    if ( count($relations) == 0) {
                        $gtu = new GrupoTreinamentoUsuario();
                        $gtu->grupo_id = $idAgrupamento;
                        $gtu->usuario_id = $user;
                        $gtu->save();
                    }
                }
                break;

            case '2': // Grupo de Divulgação
                # code...
                break;
            
            default: // (0) == Setor
                $users = User::select('id')->where('setor_id', '=', $idAgrupamento)->get()->pluck('id');
                $array =  (array) $users;
                foreach($novosUsuariosVinculados as $key => $user) {
                    if (!in_array($user, $array)) {
                        $u = User::where('id', '=', $user)->get();
                        $u[0]->setor_id = $idAgrupamento;
                        $u[0]->save();
                    }
                }
                break;
        }        

        return redirect()->route('configuracoes')->with('link_success', 'valor');
    }

}
