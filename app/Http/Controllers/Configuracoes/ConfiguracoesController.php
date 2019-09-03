<?php

namespace App\Http\Controllers\Configuracoes;

use App\Classes\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{DB, View};
use App\Http\Requests\{EditSectorRequest, NewGroupingRequest, NumberDefaultRequest};
use App\{AprovadorSetor, Configuracao, GrupoDivulgacao, GrupoDivulgacaoUsuario, GrupoTreinamento, GrupoTreinamentoUsuario, Setor, User};

class ConfiguracoesController extends Controller
{
    
    public function index() {
        $usuariosCadastrados = User::orderBy('name')->select('id', 'name', 'username', 'email', 'permissao_elaborador')->get();

        $setoresEmpresa = DB::table('setor')
                            ->join('tipo_setor', 'tipo_setor.id', '=', 'setor.tipo_setor_id')
                            ->select('setor.*', 'tipo_setor.nome AS nome_tipo')
                            ->where('setor.tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)
                            ->orderBy('nome')
                            ->get();

        $configs = Configuracao::orderBy('id')->get();
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->orderBy('name')->get()->pluck('name', 'id');
        $setores = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->orderBy('nome')->get()->pluck('nome', 'id')->toArray();

        return view('configuracoes.index', ['usuariosCadastrados' => $usuariosCadastrados, 'setoresEmpresa' => $setoresEmpresa, 'setores' => $setores,
                                            'numeroPadraoParaCodigo' => $configs[0]->numero_padrao_codigo, 'numeroPadraoDG' => $configs[2]->numero_padrao_codigo, 'numeroPadraoPG' => $configs[3]->numero_padrao_codigo, 
                                            'adminSetorQualidade' => $configs[1]->admin_setor_qualidade, 'usuariosSetorQualidade' => $usuariosSetorQualidade ]);
    }


    public function filter(Request $request) {
        $usuariosCadastrados = User::where('setor_id', '=', $request->get('search_setor'))->orderBy('name')->select('id', 'name', 'username', 'email', 'permissao_elaborador')->get();

        $setoresEmpresa = DB::table('setor')
                            ->join('tipo_setor', 'tipo_setor.id', '=', 'setor.tipo_setor_id')
                            ->select('setor.*', 'tipo_setor.nome AS nome_tipo')
                            ->where('setor.tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)
                            ->orderBy('nome')
                            ->get();

        $configs = Configuracao::all();
        $usuariosSetorQualidade = User::where('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->orderBy('name')->get()->pluck('name', 'id');
        $setores = Setor::where('tipo_setor_id', '=', Constants::$ID_TIPO_SETOR_SETOR_NORMAL)->where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->orderBy('nome')->get()->pluck('nome', 'id')->toArray();

        return view('configuracoes.index', ['usuariosCadastrados' => $usuariosCadastrados, 'setoresEmpresa' => $setoresEmpresa, 'setores' => $setores,
                                            'numeroPadraoParaCodigo' => $configs[0]->numero_padrao_codigo, 'numeroPadraoDG' => $configs[2]->numero_padrao_codigo, 'numeroPadraoPG' => $configs[3]->numero_padrao_codigo, 
                                            'adminSetorQualidade' => $configs[1]->admin_setor_qualidade, 'usuariosSetorQualidade' => $usuariosSetorQualidade ]);
    }

    // Salva número padrão para as Instruções de Trabalho
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

    // Salva número padrão para as Diretrizes de Gestão
    public function saveNumberDefaultDG(Request $request) {
        $c = "0";

        if( strlen($request->numeroPadraoDG) < 4 ) {
            if( strlen($request->numeroPadraoDG) == 1 ) $c = "0";
            else if( strlen($request->numeroPadraoDG) == 2)  $c = "00";
            else $c = "000";
        } else {
            $c = "000.";
        }
        
        try {
            $config = Configuracao::find(3);
            $config->numero_padrao_codigo = $c;
            $config->save();
        } catch (\Exception $th) {
            //throw $th;
        }

        return redirect()->route('configuracoes')->with(['padrao_sucesso_dg' => 'valor']);
    }

    // Salva número padrão para os Procedimentos de Gestão
    public function saveNumberDefaultPG(Request $request) {
        $c = "0";

        if( strlen($request->numeroPadraoPG) < 4 ) {
            if( strlen($request->numeroPadraoPG) == 1 ) $c = "0";
            else if( strlen($request->numeroPadraoPG) == 2)  $c = "00";
            else $c = "000";
        } else {
            $c = "000.";
        }
        
        try {
            $config = Configuracao::find(4);
            $config->numero_padrao_codigo = $c;
            $config->save();
        } catch (\Exception $th) {
            //throw $th;
        }

        return redirect()->route('configuracoes')->with(['padrao_sucesso_pg' => 'valor']);
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


    public function saveQualityAdmin(Request $request) {
        $config = Configuracao::where('id', '=', 2)->get();
        $config[0]->admin_setor_qualidade = $request->userAdminQuality;
        $config[0]->save();

        return redirect()->route('configuracoes')->with(['admin_qualidade_sucesso' => 'valor']);
    }


    public function editSector(EditSectorRequest $request) {
        $setor = Setor::where('id', '=', $request->id_do_setor)->get();
        $setor[0]->nome = $request->nome_do_setor;
        $setor[0]->sigla = $request->sigla_do_setor;
        $setor[0]->descricao = $request->descrição_do_setor;
        $setor[0]->save();

        return redirect()->route('configuracoes')->with(['edit_sector_success' => 'valor']);
    }


    public function linkUsersSectors($id) {
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
        
        //Khalil was in here
        
        $noSector_sector = Setor::where('nome', '=', Constants::$NOME_SETOR_SEM_SETOR)->get(); // D A F U K
        $noSectorsUsers = User::whereNull('setor_id')->orWhere('setor_id', '=', $noSector_sector[0]->id)->get()->pluck('name', 'id');
        $usersAndSectors['Sem Setor'] = $noSectorsUsers;

        //Khalil is out


        $setorAtual = Setor::where('id', '=', $id)->get();
        $text_agrupamento = "ao setor '" . $setorAtual[0]->nome . "'";
        $checkGrouping = $setorAtual[0]->nome;

        return view('configuracoes.link-users', ['text_agrupamento' => $text_agrupamento, 'checkGrouping' => $checkGrouping, 'setor' => $setorAtual[0], 'setoresUsuarios' => $usersAndSectors]);
    }


    public function linkApproverSector($id) {
        $usersAndSectors = [];

        $allSectors = Setor::where('nome', '!=', Constants::$NOME_SETOR_SEM_SETOR)->orderBy('nome')->get();
        foreach($allSectors as $key => $sector) {
            $arrUsers = [];
            $users = User::where('setor_id', '=', $sector->id)->get();
            foreach($users as $key2 => $user) {
                $arrUsers[$user->id] = $user->name;
            }
            $usersAndSectors[$sector->nome] = $arrUsers;
        }
        
        //Khalil was in here
        // And the Big John had to come adjust
        /* // adiós y lamento, amigo
        $noSectorsUsers = User::whereNull('setor_id')->get()->pluck('name', 'id');
        $usersAndSectors['Sem Setor'] = $noSectorsUsers;        
        */
        //Khalil is out
        // Big John: "Given mission is accomplished mission"


        $setorAtual = Setor::where('id', '=', $id)->get();
        $text_agrupamento = $setorAtual[0]->nome;
        
        // Pega todos os aprovadores do setor atual
        $runQuery = AprovadorSetor::where('setor_id', '=', $id)->get()->pluck('usuario_id')->toArray();
        $aprovadoresSetorAtual = ( count($runQuery) > 0 ) ? $runQuery : null;

        return view('configuracoes.link-users', ['text_agrupamento' => $text_agrupamento, 'checkGrouping' => $aprovadoresSetorAtual, 'setorDosAprovadores' => $setorAtual[0], 'setoresUsuarios' => $usersAndSectors]);
    }


    public function linkSave(Request $request) {
        $novosUsuariosVinculados = $request->usersLinked;

        $tipoAgrupamento = $request->tipo_agrupamento;
        $idAgrupamento   = $request->id_agrupamento;

        switch ($tipoAgrupamento) {
            case '1': // Grupo de Treinamento
                if( is_array($novosUsuariosVinculados) ) {
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
                }
                break;

            case '2': // Grupo de Divulgação
                if( is_array($novosUsuariosVinculados) ) {
                    foreach($novosUsuariosVinculados as $key => $user) {
                        $relations = DB::table('grupo_divulgacao_usuario')->where([
                            ['grupo_id', '=', $idAgrupamento],
                            ['usuario_id', '=', $user]
                        ])->get();
                        
                        if ( count($relations) == 0) {
                            $gtu = new GrupoDivulgacaoUsuario();
                            $gtu->grupo_id = $idAgrupamento;
                            $gtu->usuario_id = $user;
                            $gtu->save();
                        }
                    }
                }
                break;

            case '3': // Aprovadores
                if( is_array($novosUsuariosVinculados) ) {
                    foreach($novosUsuariosVinculados as $key => $user) {
                        $relations = DB::table('aprovador_setor')->where([
                            ['usuario_id', '=', $user],
                            ['setor_id', '=', $idAgrupamento]
                        ])->get();
                        
                        if ( count($relations) == 0) {
                            $aprovSetor = new AprovadorSetor();
                            $aprovSetor->usuario_id = $user;
                            $aprovSetor->setor_id = $idAgrupamento;
                            $aprovSetor->save();
                        }
                    }
                }
                break;
            
            default: // (0) == Setor
                $users = User::select('id')->where('setor_id', '=', $idAgrupamento)->get()->pluck('id');
                $array =  (array) $users;

                if( is_array($novosUsuariosVinculados) ) {
                    foreach($novosUsuariosVinculados as $key => $user) {
                        if (!in_array($user, $array)) {
                            $u = User::where('id', '=', $user)->get();
                            $u[0]->setor_id = $idAgrupamento;
                            $u[0]->save();
                        }
                    }
                }
                break;
        }        

        return redirect()->route('configuracoes')->with('link_success', 'valor');
    }


    public function defineAprovadoresListaPresenca($_setorID) {
        $usuariosDoSetorCapitalHumano = User::where('setor_id', '=', $_setorID)->get();
        return view('configuracoes.lista-presenca_aprovadores', compact('usuariosDoSetorCapitalHumano'));
    }

}
