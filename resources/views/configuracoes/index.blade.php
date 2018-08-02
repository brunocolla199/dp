@extends('layouts.app')

@section('content')
    <!-- O que fazer nesta situação? -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    @if (session('padrao_sucesso'))
		<input type="hidden" name="status" id="status" value="padrao_sucesso">
    @elseif (session('new_grouping_sucesso'))
		<input type="hidden" name="status" id="status" value="new_grouping_sucesso">
    @elseif (session('edit_sector_success'))
		<input type="hidden" name="status" id="status" value="edit_sector_success">
    @elseif (session('edit_training-group_success'))
		<input type="hidden" name="status" id="status" value="edit_training-group_success">
    @elseif (session('edit_disclosure-group_success'))
		<input type="hidden" name="status" id="status" value="edit_disclosure-group_success">
    @elseif (session('link_success'))
		<input type="hidden" name="status" id="status" value="link_success">
    @endif

    <script>
        $(document).ready(function(){
            // Verifica se acabou de gravar uma nova solicitação
            var status = $("#status").val();
            if(status == "padrao_sucesso") {
                showToast('Sucesso!', 'O número padrão para geração do código do documento foi atualizado.', 'success');
            } else if(status == "new_grouping_sucesso") {
                showToast('Sucesso!', 'Novo agrupamento criado com sucesso.', 'success');
            } else if(status == "edit_sector_success") {
                showToast('Sucesso!', 'Setor editado com sucesso.', 'success');
            } else if(status == "edit_training-group_success") {
                showToast('Sucesso!', 'Grupo de Treinamento editado com sucesso.', 'success');
            } else if(status == "edit_disclosure-group_success") {
                showToast('Sucesso!', 'Grupo de Divulgação editado com sucesso.', 'success');
            } else if(status == "link_success") {
                showToast('Sucesso!', 'Vinculações atualizadas com sucesso.', 'success');
            }
        });
    </script>

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Configurações</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Configurações</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-xl pull-right m-l-10" data-toggle="tooltip" title="{{ count(\App\Classes\Helpers::instance()->getNotifications( Auth::user()->id )) }}">
                            <i class="ti-comment-alt text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                             <!-- Nav tabs -->
                             <ul class="nav nav-tabs nav-fill customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link font-bold active" data-toggle="tab" href="#agrupamentos" role="tab"><h3 class="hidden-xs-down">AGRUPAMENTOS</h3></a> </li>
                                <li class="nav-item"> <a class="nav-link font-bold" data-toggle="tab" href="#novoAgrupamento" role="tab"><h3 class="hidden-xs-down">NOVO AGRUPAMENTO</h3></a> </li>
                                <li class="nav-item"> <a class="nav-link font-bold" data-toggle="tab" href="#padroes" role="tab"><h3 class="hidden-xs-down">PADRÕES</h3></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <!-- 
                                    /* TAB - Agrupamentos */ 
                                -->
                                <div class="tab-pane active" id="agrupamentos" role="tabpanel">
                                    <div class="p-20">
                                        
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-fill customtab" role="tablist">
                                            <li class="nav-item"> <a class="nav-link speed-subtabs ovo" style="cursor: pointer" data-toggle="collapse" data-target="#setores-empresa" aria-expanded="false" aria-controls="setores-empresa" role="tab"> <i class="fa fa-sitemap"></i> <span class="hidden-xs-down"> SETORES DA EMPRESA</span></a> </li>
                                            <li class="nav-item"> <a class="nav-link speed-subtabs" style="cursor: pointer" data-toggle="collapse" data-target="#grupos-treinamento" aria-expanded="false" aria-controls="grupos-treinamento" role="tab"> <i class="fa fa-gavel"></i>   <span class="hidden-xs-down"> GRUPOS DE TREINAMENTO</span></a> </li>
                                            <li class="nav-item"> <a class="nav-link speed-subtabs" style="cursor: pointer" data-toggle="collapse" data-target="#grupos-divulgacao" aria-expanded="false" aria-controls="grupos-divulgacao" role="tab">  <i class="fa fa-bullhorn"></i>      <span class="hidden-xs-down"> GRUPOS DE DIVULGAÇÃO</span></a> </li>
                                            <li class="nav-item"> <a class="nav-link speed-subtabs" style="cursor: pointer" data-toggle="collapse" data-target="#diretoria_gerencia" aria-expanded="false" aria-controls="diretoria_gerencia" role="tab">  <i class="fa fa-briefcase"></i>      <span class="hidden-xs-down"> DIRETORIA/GERÊNCIA</span></a> </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="collapse" id="setores-empresa" role="tabpanel">
                                                <div class="p-20">
                                                    <div class="row">                                                        

                                                        <div class="row mt-5 margin-top-1percent">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome do Setor</th>
                                                                            <th>Sigla</th>
                                                                            <th>Descrição</th>
                                                                            <th>Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($setoresEmpresa as $setor)
                                                                            <tr>
                                                                                <td><a href="javascript:void(0)">{{ $setor->nome }}</a></td> 
                                                                                <td>{{ $setor->sigla }}</td>
                                                                                <td>{{ $setor->descricao }}</td>
                                                                                <td class="text-nowrap">
                                                                                    <center>
                                                                                        <a href="{{ route('configuracoes.link.users_sectors', ['id' => $setor->id]) }}" class="sa-warning mr-3" data-toggle="tooltip" data-original-title="Vincular Usuários"> <i class="fa fa-exchange text-info"></i> </a>
                                                                                        <a href="#" class="open-edit-sector-modal" data-id="{{$setor->id}}" data-nome="{{$setor->nome}}" data-sigla="{{$setor->sigla}}" data-desc="{{$setor->descricao}}" data-toggle="tooltip" data-original-title="Editar"> <i data-toggle="modal" data-target="#edit-sector-modal" class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                                                        <!-- <a href="#" class="sa-warning" data-toggle="tooltip" data-original-title="Excluir"> <i class="fa fa-close text-danger"></i> </a> -->
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse" id="grupos-treinamento" role="tabpanel">
                                                <div class="p-20">
                                                    <div class="row">
                                                        <div class="row mt-5 margin-top-1percent">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome do Grupo</th>
                                                                            <th>Descrição</th>
                                                                            <th>Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($gruposTreinamento as $grupoT)
                                                                            <tr>
                                                                                <td><a href="javascript:void(0)">{{ $grupoT->nome }}</a></td> 
                                                                                <td>{{ $grupoT->descricao }}</td>
                                                                                <td class="text-nowrap">
                                                                                    <center>
                                                                                        <a href="{{ route('configuracoes.link.users_training-group', ['id' => $grupoT->id]) }}" class="sa-warning mr-3" data-toggle="tooltip" data-original-title="Vincular Usuários"> <i class="fa fa-exchange text-info"></i> </a>
                                                                                        <a href="#" class="open-edit-training-group" data-id="{{$grupoT->id}}" data-nome="{{$grupoT->nome}}" data-desc="{{$grupoT->descricao}}" data-toggle="tooltip" data-original-title="Editar"> <i data-toggle="modal" data-target="#edit-training-group-modal" class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                                                        <!-- <a href="#" class="sa-warning" data-toggle="tooltip" data-original-title="Excluir"> <i class="fa fa-close text-danger"></i> </a> -->
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse" id="grupos-divulgacao" role="tabpanel">
                                                <div class="p-20">
                                                    <div class="row">
                                                        <div class="row mt-5 margin-top-1percent">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome do Grupo</th>
                                                                            <th>Descrição</th>
                                                                            <th>Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($gruposDivulgacao as $grupoD)
                                                                            <tr>
                                                                                <td><a href="javascript:void(0)">{{ $grupoD->nome }}</a></td> 
                                                                                <td>{{ $grupoD->descricao }}</td>
                                                                                <td class="text-nowrap">
                                                                                    <center>
                                                                                        <a href="{{ route('configuracoes.link.users_disclosure-group', ['id' => $grupoD->id]) }}" class="sa-warning mr-3" data-toggle="tooltip" data-original-title="Vincular Usuários"> <i class="fa fa-exchange text-info"></i> </a>
                                                                                        <a href="#" class="open-edit-disclosure-group" data-id="{{$grupoD->id}}" data-nome="{{$grupoD->nome}}" data-desc="{{$grupoD->descricao}}" data-toggle="tooltip" data-original-title="Editar"> <i data-toggle="modal" data-target="#edit-disclosure-group-modal" class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                                                        <!-- <a href="#" class="sa-warning" data-toggle="tooltip" data-original-title="Excluir"> <i class="fa fa-close text-danger"></i> </a> -->
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse" id="diretoria_gerencia" role="tabpanel">
                                                <div class="p-20">
                                                    <div class="row">
                                                        <h5 class="alert alert-info alert-dismissible" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            Os setores especiais <b>Diretoria</b> e <b>Gerência</b> não podem ser modificados, pois são padrões dentro do sistema.
                                                        </h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="row mt-3 margin-top-1percent">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome do Setor Especial</th>
                                                                            <th>Descrição</th>
                                                                            <th>Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($diretoriaGerencia as $dg)
                                                                            <tr>
                                                                                <td><a href="javascript:void(0)">{{ $dg->nome }}</a></td> 
                                                                                <td>{{ $dg->descricao }}</td>
                                                                                <td class="text-nowrap">
                                                                                    <center>
                                                                                        <a href="{{ route('configuracoes.link.users_direction-management', ['id' => $dg->id]) }}" class="sa-warning" data-toggle="tooltip" data-original-title="Vincular Usuários"> <i class="fa fa-exchange text-info"></i> </a>
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <!-- 
                                    /* TAB - Novo Agrupamento */ 
                                -->
                                <div class="tab-pane  p-20" id="novoAgrupamento" role="tabpanel">
                                    <div class="col-md-12">
                                        <div class="col-md-12 mb-4">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                          
                                        {!! Form::open(['route' => 'configuracoes.save.new-grouping', 'class' => 'form-horizontal', 'id' => 'form-generate-document']) !!}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-12 control-label font-bold">
                                                            {!! Form::label('nome_do_agrupamento', 'NOME DO AGRUPAMENTO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::text('nome_do_agrupamento', null, ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-6 control-label font-bold">
                                                            {!! Form::label('tipo_do_agrupamento', 'TIPO DO AGRUPAMENTO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::select('tipo_do_agrupamento', ['Setor', 'Grupo de Treinamento', 'Grupo de Divulgação'], '', ['class' => 'form-control  custom-select']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-6 control-label font-bold">
                                                            {!! Form::label('descrição', 'DESCRIÇÃO DO AGRUPAMENTO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::textarea('descrição', null, ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="col-md-offset-6 col-md-3 pull-right">
                                                        {!! Form::submit('Salvar Agrupamento', ['class' => 'btn btn-lg btn-success']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        {!! Form::close() !!}

                                    </div> 
                                </div>


                                <!-- 
                                    /* TAB - Padrões */ 
                                -->
                                <div class="tab-pane  p-20" id="padroes" role="tabpanel">
                                    <div class="col-md-12"> 
                                           
                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="col-md-12 mb-4">
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @else
                                                            <div class="alert alert-info">
                                                                <span><b>Exemplos de valores aceitos:</b></span>
                                                                <ul>
                                                                    <li>0       <span class="text-muted">- Código gerado será [1, 2, 3....]</span></li>
                                                                    <li>000     <span class="text-muted">- Código gerado será [001, 002, 003....]</span></li>
                                                                    <li>000.    <span class="text-muted">- Código gerado será [001.01, 002.01, 003.01....]</span></li>
                                                                </ul>
                                                                <small><b>Lembre-se:</b> são aceitos apenas 4 dígitos, sendo que o último deve ser um ponto (.)!</small>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    {!! Form::open(['route' => 'configuracoes.save.number-default', 'class' => 'form-horizontal']) !!}
                                                    <div class="form-group">
                                                        <div class="col-md-12 control-label font-bold">
                                                            {!! Form::label('numeroPadrao', 'PADRÃO PARA NÚMERO DO CÓDIGO DE DOCUMENTO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::text('numeroPadrao', $numeroPadraoParaCodigo, ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-offset-8 pull-right col-md-4 mt-4">
                                                            <button type="submit" class="btn btn-block btn-outline-success">Salvar</button>
                                                        </div>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>

                                        </div>
                                    </div> 
                                </div>
                                          

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->


            <!-- modal para editar setor -->
            <div id="edit-sector-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Alterando informações do setor</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        {!! Form::open(['route' => 'configuracoes.edit.sector', 'class' => 'form-horizontal']) !!}
                            <div class="modal-body">
                                <div class="col-md-12 mb-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                {!! Form::hidden('id_do_setor', '', ['id' => 'id_do_setor']) !!}
                                <div class="form-group">
                                    {!! Form::label('nome_do_setor', 'NOME DO SETOR:') !!}
                                    {!! Form::text('nome_do_setor', null, ['class' => 'form-control', 'id' => 'nome_do_setor']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('sigla_do_setor', 'SIGLA DO SETOR:') !!}
                                    {!! Form::text('sigla_do_setor', null, ['class' => 'form-control', 'id' => 'sigla_do_setor']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('descrição_do_setor', 'DESCRIÇÃO DO SETOR:') !!}
                                    {!! Form::textarea('descrição_do_setor', null, ['class' => 'form-control', 'id' => 'descrição_do_setor']) !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.modal para editar setor -->


            <!-- modal para editar grupo de treinamento -->
            <div id="edit-training-group-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Alterando informações do grupo de treinamento</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        {!! Form::open(['route' => 'configuracoes.edit.training-group', 'class' => 'form-horizontal']) !!}
                            <div class="modal-body">
                                <div class="col-md-12 mb-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                {!! Form::hidden('id_do_grupo_de_treinamento', '', ['id' => 'id_do_grupo_de_treinamento']) !!}
                                <div class="form-group">
                                    {!! Form::label('nome_do_grupo_de_treinamento', 'NOME DO GRUPO DE TREINAMENTO:') !!}
                                    {!! Form::text('nome_do_grupo_de_treinamento', null, ['class' => 'form-control', 'id' => 'nome_do_grupo_de_treinamento']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('descrição_do_grupo_de_treinamento', 'DESCRIÇÃO DO GRUPO DE TREINAMENTO:') !!}
                                    {!! Form::textarea('descrição_do_grupo_de_treinamento', null, ['class' => 'form-control', 'id' => 'descrição_do_grupo_de_treinamento']) !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.modal para editar grupo de treinamento -->


            <!-- modal para editar grupo de divulgação -->
            <div id="edit-disclosure-group-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Alterando informações do grupo de divulgação</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        {!! Form::open(['route' => 'configuracoes.edit.disclosure-group', 'class' => 'form-horizontal']) !!}
                            <div class="modal-body">
                                <div class="col-md-12 mb-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                {!! Form::hidden('id_do_grupo_de_divulgação', '', ['id' => 'id_do_grupo_de_divulgação']) !!}
                                <div class="form-group">
                                    {!! Form::label('nome_do_grupo_de_divulgação', 'NOME DO GRUPO DE DIVULGAÇÃO:') !!}
                                    {!! Form::text('nome_do_grupo_de_divulgação', null, ['class' => 'form-control', 'id' => 'nome_do_grupo_de_divulgação']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('descrição_do_grupo_de_divulgação', 'DESCRIÇÃO DO GRUPO DE DIVULGAÇÃO:') !!}
                                    {!! Form::textarea('descrição_do_grupo_de_divulgação', null, ['class' => 'form-control', 'id' => 'descrição_do_grupo_de_divulgação']) !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Salvar</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.modal para editar grupo de divulgação -->


            <script type="text/javascript" language="javascript">
                // Click para abrir modal de editar setor
                $(document).on("click", ".open-edit-sector-modal", function () {
                    var id = $(this).data('id');
                    var nome = $(this).data('nome');
                    var sigla = $(this).data('sigla');
                    var descricao = $(this).data('desc');
                    $("#id_do_setor").val(id);
                    $("#nome_do_setor").val(nome);
                    $("#sigla_do_setor").val(sigla);
                    $("#descrição_do_setor").val(descricao);
                });

                // Click para abrir modal de editar grupo de treinamento
                $(document).on("click", ".open-edit-training-group", function () {
                    var id = $(this).data('id');
                    var nome = $(this).data('nome');
                    var descricao = $(this).data('desc');
                    $("#id_do_grupo_de_treinamento").val(id);
                    $("#nome_do_grupo_de_treinamento").val(nome);
                    $("#descrição_do_grupo_de_treinamento").val(descricao);
                });

                // Click para abrir modal de editar grupo de divulgação
                $(document).on("click", ".open-edit-disclosure-group", function () {
                    var id = $(this).data('id');
                    var nome = $(this).data('nome');
                    var descricao = $(this).data('desc');
                    $("#id_do_grupo_de_divulgação").val(id);
                    $("#nome_do_grupo_de_divulgação").val(nome);
                    $("#descrição_do_grupo_de_divulgação").val(descricao);
                });

                // Destacando a subtab
                $("a.speed-subtabs").click(function(){
                    $("a.speed-subtabs").each(function(index){
                        $(this).removeClass('speed-subtab-custom');
                    });
                    $(this).addClass('speed-subtab-custom');
                });
            </script>

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper -->
    <!-- ============================================================== -->

@endsection