@extends('layouts.app')

@section('content')
    <!-- O que fazer nesta situação? -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"  rel="stylesheet">
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    
    <link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}"  rel="stylesheet">
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
                    <h3 class="text-themecolor m-b-0 m-t-0">Documentação</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Documentação</li>
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
                                            {!! Form::open(['route' => 'documentacao.validate-data', 'class' => 'form-horizontal', 'id' => 'form-generate-document']) !!}
                                                <!-- Linha 1 -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('tipo_documento', 'TIPO DE DOCUMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('tipo_documento', $tipoDocumentos, '-- Selecione --', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('aprovador', 'APROVADOR:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('aprovador', ['Aqui devemos decidir', 'se o melhor é criar', 'um novo "setor" especial chamado Aprovadores', 'ou se colocamos um permissionamento no usuário', '(Questão de Gerência e diretoria'], '', ['class' => 'form-control  custom-select']) !!}
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
                                                                {!! Form::select('areaTreinamento', $gruposTreinamento, '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('grupoDivulgacao', 'GRUPO DE DIVULGAÇÃO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('grupoDivulgacao', $gruposDivulgacao, '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Linha 3 --> 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('setor_dono_doc', 'Setor (dono do documento):') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('setor_dono_doc', $setores, '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-8 control-label font-bold">
                                                                {!! Form::label('validadeDocumento', 'VALIDADE DO DOCUMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::text('validadeDocumento', date('d/m/Y'), ['class' => 'form-control', 'id' => 'mdate']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Linha 4 -->
                                                <div class="row">
                                                    <small>Aqui temos que ver como vai ficar, tendo em vista que ela solicitou que mais de um setor e um ou mais usuários possam ser escolhidos (muda BD, inclusive).</small>

                                                    <div class="col-md-12">
                                                        <div class="col-md-12 control-label font-bold">
                                                            {!! Form::label('grupoInteresse', 'GRUPO DE INTERESSE:') !!}
                                                            <span class="text-muted" style="font-weight: normal"> Escolha abaixo se este grupo de interesse é <code>um usuário</code> ou <code>um setor</code>. </span>
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-6 bt-switch">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <input id="ckb_tipo_area_interesse" name="tipo_area_interesse" type="checkbox" checked data-size="large" data-on-text="Usuário" data-off-text="Setor" data-on-color="info" data-off-color="success"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                {!! Form::select('grupoInteresse', $usuariosInteresse, '', ['class' => 'form-control  custom-select', 'id' => 'grupoInteresse']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Linha 5 -->
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
                                                    
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <button type="button" id="importDocument" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">IMPORTAR DOCUMENTO</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <button type="button" id="createDocument" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">CRIAR DOCUMENTO</button>
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
                                                            <th>Título do Documento</th>
                                                            <th>Código</th>
                                                            <th>Tipo do Documento</th>
                                                            <th>Status</th>
                                                            <th>Validade</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach($documentos as $documento)
                                                        <tr>
                                                            {{ Form::open(['route' => 'documentacao.view-document', 'method' => 'POST']) }}
                                                                {{ Form::hidden('document_id', $documento->id) }}
                                                                <td>
                                                                    {!! Form::submit($documento->nome, ['class' => 'a-href-submit']) !!}
                                                                </td>
                                                            {{ Form::close() }}

                                                            <td> {{ $documento->codigo }} </td>

                                                            <td><span class="text-muted"><i class="fa fa-file-text-o"></i></span> {{ $documento->nome_tipo }} </td>
                                                            <td>
                                                                <p class="text-muted font-weight-bold"> {{ $documento->etapa }} </p>
                                                            </td>
                                                            <td>{{ date("d/m/Y", strtotime($documento->validade)) }}</td>
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

            <script>
                var tipoAreaInteresse = "usuario";

                // Material Date picker   
                $('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: new Date(), lang: 'pt-br', format: 'DD/M/YYYY', currentDate: new Date(), cancelText: 'Cancelar', okText: 'Definir' });

                // Date Picker
                jQuery('.mydatepicker, #datepicker').datepicker();
                jQuery('#datepicker-autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });

                /*
                *   QUANDO CARREGAR A PÁGINA
                */
                $(document).ready(function(){
                    var arr = ["IT - 012 - V2", "DP - 12 - V1", "IT - 07 - V2", "IT - 05 - V2", "PG-09-V2", "DG-01-V3", "IT - 012 - V2", "DP - 12 - V1", "IT - 07 - V2", "IT - 05 - V2"];
                    for(var i=0; i<10; i++) {
                        $.toast({
                            heading: '<b>' + arr[i] + '</b>',
                            text: 'O documento código '+ arr[i] +' vence em <b>20/04/2018</b>.',
                            position: 'top-right',
                            bgColor: '#03739a',  // Background color of the toast
                            textColor: '#eeeeee',  // Text color of the toast
                            textAlign: 'left', 
                            allowToastClose: true,
                            hideAfter: 200, // false
                            stack: 6
                        });
                    }

                    // Get bootstrap switch value => [STATE] true = usuario | false = setor
                    $('input[name="tipo_area_interesse"]').on('switchChange.bootstrapSwitch', function(event, state) {
                        var route = (state) ? " {{ URL::route('retornarUsuarios') }} " : " {{ URL::route('retornarSetores') }} ";
                        tipoAreaInteresse  = (state) ? "usuario" : "setor";
                        $("#tituloDocumento").val("");
                        
                        $.ajax({
				    		type: 'GET',
				    		url: route,
				    		dataType: 'JSON',
				    		success: function (data) {
                                $("#grupoInteresse option").remove();

                                var cont = 0;
                                $.each(data.response, function( index, value ){
                                    $("#grupoInteresse").append('<option value="' + index + '">' + value.split(';')[0]  + '</option>');
                                });
				            }, error: function (err) {
				            	console.log(err);
				            }
                        });                         
                    });

                    // Envia o form conforme o botão que foi clicado
                    $("#importDocument").click(function(){
                        var input = $("<input>").attr("type", "hidden").attr("name", "action").val("import");
                        $('#form-generate-document').append($(input));
                        $('#form-generate-document').submit();
                    });
                    $("#createDocument").click(function(){
                        var input = $("<input>").attr("type", "hidden").attr("name", "action").val("create");
                        $('#form-generate-document').append($(input));
                        $('#form-generate-document').submit();
                    });


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