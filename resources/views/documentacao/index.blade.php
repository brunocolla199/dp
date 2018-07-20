@extends('layouts.app')

@section('content')
    <!-- O que fazer nesta situação? -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"  rel="stylesheet">
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    



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
                                                            <div class="col-md-10 control-label font-bold">
                                                                {!! Form::label('setor_dono_doc', 'Setor:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('setor_dono_doc', $setores, '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                </div>

                                                <!-- Linha 2 -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-10 control-label font-bold">
                                                                {!! Form::label('nivelAcessoDocumento', 'NÍVEL DE ACESSO AO DOCUMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('nivelAcessoDocumento', [Constants::$NIVEL_ACESSO_DOC_LIVRE, Constants::$NIVEL_ACESSO_DOC_RESTRITO, Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL], '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('aprovador', 'APROVADOR:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                <select class="form-control custom-select" name="aprovador" id="aprovador" style="width: 100%"> <!-- colocar classe = select2 -->
                                                                    <optgroup label="Diretoria">
                                                                        @foreach($diretores_aprovadores as $key => $diretor)
                                                                            <option value="{{ $key }}">{{ $diretor }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                    <optgroup label="Gerência">
                                                                        @foreach($gerentes_aprovadores as $key => $gerente)
                                                                            <option value="{{ $key }}">{{ $gerente }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                </div>

                                                <!-- Linha 3 -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-10 control-label font-bold">
                                                                {!! Form::label('areaInteresse', 'ÁREA DE INTERESSE:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                <select multiple id="optgroup" name="areaInteresse[]">
                                                                    @foreach($setoresUsuarios as $key => $su)
                                                                        <optgroup label="{{ $key }}">
                                                                            @foreach($su as $key2 => $user)
                                                                                <option value="{{ $key2 }}">{{ $user }}</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>   
                                                    </div>                                                    
                                                </div>

                                                <!-- Linha 4 --> 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-10 control-label font-bold">
                                                                {!! Form::label('grupoTreinamento', 'GRUPO DE TREINAMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('grupoTreinamento', $gruposTreinamento, '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-10 control-label font-bold">
                                                                {!! Form::label('grupoDivulgacao', 'GRUPO DE DIVULGAÇÃO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('grupoDivulgacao', $gruposDivulgacao, '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Linha 5 --> 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-10 control-label font-bold">
                                                                {!! Form::label('validadeDocumento', 'VALIDADE DO DOCUMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::text('validadeDocumento', date('d/n/Y'), ['class' => 'form-control', 'id' => 'mdate']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-10 control-label font-bold">
                                                                {!! Form::label('copiaControlada', 'CÓPIA CONTROLADA:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                <input name="copiaControlada" type="radio" id="sim" value="true" class="with-gap radio-col-blue" />
                                                                <label for="sim">Sim</label>
                                                                <input name="copiaControlada" type="radio" id="nao" value="false" class="with-gap radio-col-light-blue" checked/>
                                                                <label for="nao">Não</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                

                                                <!-- Linha 6 -->
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
                                            <h5 class="alert alert-info alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                Quando o campo <b>Título do Documento</b> for preenchido, os outros filtros serão <b>ignorados</b>. Caso o campo seja deixado em branco, os outros filtros serão aplicados em conjunto.
                                            </h5>
                                        </div>
                                        <div class="row">
                                            <h4>FILTROS</h4>
                                            <div class="col-md-12">

                                                {!! Form::open(['route' => 'documentacao.filter-documents-index', 'class' => 'form-horizontal']) !!}
                                                    <div class="row">
                                                        <div class="col-md-3 margin-right-1percent">
                                                            <div class="row ">
                                                                {!! Form::select('search_tipoDocumento', $tipoDocumentos, '-- Selecione --', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 margin-right-1percent">
                                                            <div class="row">
                                                                <select class="form-control custom-select" name="search_aprovador" id="search_aprovador" style="width: 100%"> <!-- colocar classe = select2 -->
                                                                    <optgroup label="Diretoria">
                                                                        @foreach($diretores_aprovadores as $key => $diretor)
                                                                            <option value="{{ $key }}">{{ $diretor }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                    <optgroup label="Gerência">
                                                                        @foreach($gerentes_aprovadores as $key => $gerente)
                                                                            <option value="{{ $key }}">{{ $gerente }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 margin-right-1percent">
                                                            <div class="row ">
                                                                {!! Form::select('search_grupoTreinamento', $gruposTreinamento, '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 margin-right-1percent">
                                                            <div class="row">
                                                                <div class="input-group">
                                                                    {!! Form::text('search_validadeDocumento', date('d/n/Y'), ['class' => 'form-control', 'id' => 'mdate_search']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="row margin-top-1percent">
                                                        <div class="col-md-3 margin-right-1percent">
                                                            <div class="row">
                                                                {!! Form::select('search_grupoDivulgacao', $gruposDivulgacao, '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 margin-right-1percent">
                                                            <div class="row">
                                                                {!! Form::text('search_tituloDocumento', null, ['class' => 'form-control', 'placeholder' => 'Título do Documento']) !!}
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-1 mr-4">
                                                            <a href="{{ route('documentacao') }}" class="btn waves-effect waves-light btn-secondary"><i class="fa fa-ban"></i> Limpar</a>
                                                        </div>
                                                        <div class="col-md-3 margin-right-1percent">
                                                            <button type="submit" class="btn btn-block waves-effect waves-light btn-outline-success"><i class="fa fa-search"></i> Buscar</button>
                                                        </div>
                                                    </div> 
                                                {!! Form::close() !!} 
                                                
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

                // Material Date picker   
                $('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: new Date(), lang: 'pt-br', format: 'DD/M/YYYY', currentDate: new Date(), cancelText: 'Cancelar', okText: 'Definir' });
                $('#mdate_search').bootstrapMaterialDatePicker({ weekStart : 0, time: false, lang: 'pt-br', format: 'DD/M/YYYY', currentDate: new Date(), cancelText: 'Cancelar', okText: 'Definir' });



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
                            hideAfter: 100, // false
                            stack: 6
                        });
                    }

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