@extends('layouts.app')

@section('content')
    <!-- O que fazer nesta situação? -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>


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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active">Configurações</li>
                    </ol>
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
                                <li class="nav-item"> <a class="nav-link font-bold active" data-toggle="tab" href="#grupos" role="tab"><h3 class="hidden-xs-down">GRUPOS</h3></a> </li>
                                <li class="nav-item"> <a class="nav-link font-bold" data-toggle="tab" href="#tiposDeGrupos" role="tab"><h3 class="hidden-xs-down">TIPOS DE GRUPOS</h3></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <!-- 
                                    /* TAB - Grupos */ 
                                -->
                                <div class="tab-pane active" id="grupos" role="tabpanel">
                                    <div class="p-20">
                                        <div class="col-md-12">
                                            

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
                                                            @foreach($grupos as $grupo)
                                                                <tr>
                                                                    <td><a href="javascript:void(0)">{{ $grupo->nome }}</a></td>
                                                                    <td>{{ $grupo->descricao }}</td>
                                                                    <td class="text-nowrap">
                                                                        <a href="#" data-toggle="tooltip" data-original-title="Editar"> <i data-toggle="modal" data-target="#edit-group-modal" class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                                        <a href="#" class="sa-warning" data-toggle="tooltip" data-original-title="Excluir"> <i class="fa fa-close text-danger"></i> </a>
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


                                <!-- 
                                    /* TAB - Tipos de Grupos */ 
                                -->
                                <div class="tab-pane  p-20" id="tiposDeGrupos" role="tabpanel">
                                    <div class="col-md-12">
                                          
                                        <div class="row mt-5 margin-top-1percent">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tipo do Grupo</th>
                                                            <th>Editar</th>
                                                            <th>Excluir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($tiposDeGrupos as $key => $tipo)
                                                            <tr>
                                                                <td><span class="text-muted"> {{ $key + 1 }} </span> </td>
                                                                <td><a href="javascript:void(0)">{{ $tipo->nome }}</a></td>
                                                                <td class="text-nowrap">
                                                                    <button type="button" class="btn waves-effect waves-light btn-outline-primary">Editar</button>
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    <button type="button" class="btn waves-effect waves-light btn-outline-danger">Excluir</button>
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
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->


            <!-- modal para editar grupo -->
            <div id="edit-group-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Modal Content is Responsive</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal para editar grupo -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper -->
    <!-- ============================================================== -->

@endsection