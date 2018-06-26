@extends('layouts.app')

@section('content')
    
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
                    <h3 class="text-themecolor m-b-0 m-t-0">Credenciamento</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active">Credenciamento</li>
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
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#solicitacoes" role="tab"><span class="hidden-xs-down">SOLICITAÇÕES</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cadastros" role="tab"><span class="hidden-xs-down">CADASTROS</span></a> </li>
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#documentos" role="tab"><span class="hidden-xs-down">DOCUMENTOS</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane  p-20" id="solicitacoes" role="tabpanel">1</div>
                                <div class="tab-pane  p-20" id="cadastros" role="tabpanel">2</div>
                                <div class="tab-pane active" id="documentos" role="tabpanel">
                                    <div class="p-20">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-fill customtab" role="tablist">
                                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#permissoes" role="tab"><span class="hidden-xs-down">PERMISSÕES</span></a> </li>
                                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#configuracao" role="tab"><span class="hidden-xs-down">CONFIGURAÇÃO</span></a> </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane p-20" id="permissoes" role="tabpanel">
                                                1
                                            </div>
                                            <div class="tab-pane active" id="configuracao" role="tabpanel">
                                                <div class="p-20">
                                                    <div class="row">
                                                        
                                                            <div class="col-md-4">
                                                                <div class="card">
                                                                    <center>
                                                                        <div class="card-body collapse show">
                                                                            <!-- <i class="mdi mdi-48 mdi-factory"></i>  -->
                                                                            <i class="mdi mdi-48 mdi-domain"></i> 
                                                                            <!-- <i class="mdi mdi-48 mdi-bank"></i>  -->
                                                                            <h4 class="card-title">EMPRESA</h4>
                                                                        </div>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card">
                                                                    <center>
                                                                        <div class="card-body collapse show">
                                                                            <i class="mdi mdi-48 mdi-account-multiple"></i>
                                                                            <h4 class="card-title">FUNCIONÁRIOS</h4>
                                                                        </div>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card">
                                                                    <center>
                                                                        <div class="card-body collapse show">
                                                                            <!-- <i class="mdi mdi-48 mdi-cash-usd"></i> -->
                                                                            <!-- <i class="mdi mdi-48 mdi-treasure-chest"></i> -->
                                                                            <!-- <i class="mdi mdi-48 mdi-wallet-travel"></i> -->
                                                                            <i class="mdi mdi-48 mdi-square-inc-cash"></i>
                                                                            <h4 class="card-title">TERCEIRIZADOS</h4>
                                                                        </div>
                                                                    </center> 
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
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->



        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper -->
    <!-- ============================================================== -->

@endsection