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
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#gerarDocs" role="tab"><span class="hidden-xs-down">GERAR DOCUMENTOS</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#visualizarDocs" role="tab"><span class="hidden-xs-down">VISUALIZAR DOCUMENTOS</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="gerarDocs" role="tabpanel">
                                    <div class="p-20">
                                        => 2 colunas (Cada uma com 3 linhas) <br>
                                        => 1 linha total abaixo <br>
                                        => 2 botões grandes (Importar Documentos  &&  Criar Documentos)
                                    </div>
                                </div>
                                <div class="tab-pane  p-20" id="visualizarDocs" role="tabpanel">
                                    => 2 Linhas de filtros <br>
                                    => 1 tabela abaixo <br>
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