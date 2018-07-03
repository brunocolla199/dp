@extends('layouts.app')

@section('content')
    <!-- O que fazer nesta situação? -->
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"  rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}"  rel="stylesheet">

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>



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
                                <li class="nav-item"> <a class="nav-link font-bold active" data-toggle="tab" href="#gerarDocs" role="tab"><h3 class="hidden-xs-down">GERAR DOCUMENTOS</h3></a> </li>
                                <li class="nav-item"> <a class="nav-link font-bold" data-toggle="tab" href="#visualizarDocs" role="tab"><h3 class="hidden-xs-down">VISUALIZAR DOCUMENTOS</h3></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <!-- 
                                    /* TAB - Gerar Documento */ 
                                -->
                                <div class="tab-pane active" id="gerarDocs" role="tabpanel">
                                    <div class="p-20">
                                        <div class="col-md-12">
                                            {!! Form::open(['route' => 'home', 'class' => 'form-horizontal']) !!}
                                                <!-- Linha 1 -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('tipo_documento', 'TIPO DE DOCUMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('tipo_documento', ['Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('aprovador', 'APROVADOR:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('aprovador', ['Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Linha 2 -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('areaTreinamento', 'ÁREA DE TREINAMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('areaTreinamento', ['Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('grupoInteresse', 'GRUPO DE INTERESSE:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('grupoInteresse', ['-- Selecione --', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Linha 3 -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('grupoDivulgacao', 'GRUPO DE DIVULGAÇÃO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('grupoDivulgacao', ['-- Selecione --', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-8 control-label font-bold">
                                                                {!! Form::label('validadeDocumento', 'VALIDADE DO DOCUMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::text('validadeDocumento', '2017-06-04', ['class' => 'form-control', 'id' => 'mdate']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Linha 4 -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('tituloDocumento', 'TÍTULO DO DOCUMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::text('tituloDocumento', null, ['class' => 'form-control']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Linha 5 -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">IMPORTAR DOCUMENTO</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">CRIAR DOCUMENTO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>


                                <!-- 
                                    /* TAB - Visualizar Documento */ 
                                -->
                                <div class="tab-pane  p-20" id="visualizarDocs" role="tabpanel">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <h4>FILTROS</h4>
                                            <div class="col-md-12">
                                                
                                                <div class="row">
                                                    <div class="col-md-3 margin-right-1percent">
                                                        <div class="row ">
                                                            {!! Form::select('filtroTipoDocumento', ['TIPO DE DOCUMENTO', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 margin-right-1percent">
                                                        <div class="row">
                                                            {!! Form::select('filtroAprovador', ['APROVADOR', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 margin-right-1percent">
                                                        <div class="row">
                                                            {!! Form::select('filtroAreaInteresse', ['ÁREA DE INTERESSE', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 margin-right-1percent">
                                                        <div class="row">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="datepicker-autoclose" placeholder="Validade">
                                                                <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="row margin-top-1percent">
                                                    <div class="col-md-3 margin-right-1percent">
                                                        <div class="row ">
                                                            {!! Form::select('grupoTreinamento', ['GRUPO DE TREINAMENTO', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 margin-right-1percent">
                                                        <div class="row">
                                                            {!! Form::select('grupoDivulgacao', ['GRUPO DE DIVULGAÇÃO', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 margin-right-1percent">
                                                        <div class="row">
                                                            {!! Form::text('tituloDocumento', null, ['class' => 'form-control', 'placeholder' => 'Título do Documento']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mx-auto margin-right-1percent">
                                                        <div class="row">
                                                            <button type="button" class="btn btn-secondary btn-rounded"><i class="fa fa-search"></i> Buscar</button>
                                                        </div>
                                                    </div>
                                                </div>  
                                                
                                            </div>
                                        </div>


                                        <div class="row mt-5 margin-top-1percent">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Título do Docmento</th>
                                                            <th>Código</th>
                                                            <th>Status</th>
                                                            <th>Validade</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><a href="javascript:void(0)">IT - Qualidade - Recebimento Mensal</a></td>
                                                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 16, 2017</span> </td>
                                                            <td>$45.00</td>
                                                            <td>
                                                                <div class="label label-table label-success">Pago</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript:void(0)">IT - Almoxarifado - Recebimento Mensal</a></td>
                                                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Oct 12, 2017</span> </td>
                                                            <td>$245.30</td>
                                                            <td>
                                                                <div class="label label-table label-danger">Em Aberto 2</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript:void(0)">Order #98458</a></td>
                                                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> May 18, 2017</span> </td>
                                                            <td>$38.00</td>
                                                            <td>
                                                                <div class="label label-table label-info">Em Aberto 1</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="javascript:void(0)">Order #32658</a></td>
                                                            <td><span class="text-muted"><i class="fa fa-clock-o"></i> Apr 28, 2017</span> </td>
                                                            <td>$77.99</td>
                                                            <td>
                                                                <div class="label label-table label-success">Pago</div>
                                                            </td>
                                                        </tr>
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

            <script>
                // Material Date picker   
                $('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, lang: 'pt-br',  cancelText: 'Cancelar', okText: 'Definir' });

                // Date Picker
                jQuery('.mydatepicker, #datepicker').datepicker();
                jQuery('#datepicker-autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true
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