@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Formulários</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Formulários</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-xl pull-right m-l-10"><i class="ti-comment-alt text-white"></i></button>
                    </div>
                </div>
            </div>
            
            
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
							 <!-- Nav tabs -->
                             <ul class="nav nav-tabs nav-fill customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link font-bold" data-toggle="tab" href="#novoForm" role="tab"><h3 class="hidden-xs-down">NOVO FORMULÁRIO</h3></a> </li>
                                <li class="nav-item"> <a class="nav-link font-bold active" data-toggle="tab" href="#verForms" role="tab"><h3 class="hidden-xs-down">VISUALIZAR FORMULÁRIOS</h3></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane p-20" id="novoForm" role="tabpanel">
                                    <div class="col-md-12">
                                    {!! Form::open(['route' => 'formularios.validate-data', 'method' => 'POST', 'id' => 'form-save-new-document', 'enctype' => 'multipart/form-data']) !!}
                                        
                                            {{ csrf_field() }}

                                            <!-- Linha 1 -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-10 control-label font-bold">
                                                            {!! Form::label('setor_dono_form', 'Setor:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::select('setor_dono_form', $setores, '', ['class' => 'form-control  custom-select']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-12 control-label font-bold">
                                                            {!! Form::label('grupoDivulgacao', 'GRUPO DE DIVULGAÇÃO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::select('grupoDivulgacao', $grupoDivulgacao, '', ['class' => 'form-control  custom-select']) !!}
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
                                                            {!! Form::select('nivelAcessoDocumento', [Constants::$NIVEL_ACESSO_DOC_LIVRE, Constants::$NIVEL_ACESSO_DOC_RESTRITO], '', ['class' => 'form-control  custom-select']) !!}
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-10 control-label font-bold">
                                                            {!! Form::label('documentosAtrelados', 'ATRELAR AOS DOCUMENTOS:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            <select multiple id="optgroup-documentosAtrelados" name="documentosAtrelados[]" class="form-control select2">
                                                                @foreach($documentosTipo as $key => $docs)
                                                                    <optgroup label="{{ $key }}">
                                                                        @foreach($docs as $key2 => $doc)
                                                                            <option value="{{ $doc['doc_id'] }}">{{ $doc['nome'] }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>   
                                                </div>            -->
                                            </div>

                                            <!-- Linha 3  -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-6 control-label font-bold">
                                                            {!! Form::label('tituloFormulario', 'TÍTULO DO FORMULÁRIO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::text('tituloFormulario', null, ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>                                     
                                            </div>

                                            <!-- Linha 4 -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <button type="button" id="importFormulario" class="btn waves-effect waves-light btn-block btn-lg btn-secondary" >IMPORTAR FORMULÁRIO</button>
                                                        <!-- <span> 
                                                            <small>Botão desabilitado em virtude da necessidade de disponibilizar um download específico, pois os formulários serão um tipo específico de documento 
                                                                    e, por isso, não será suportado qualquer formato.</small> 
                                                        </span> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-12">
                                                        <button disabled type="button" id="createFormulario" class="btn btn-save-new-form waves-effect waves-light btn-block btn-lg btn-secondary">CRIAR FORMULÁRIO</button>
                                                        <span> 
                                                            <small>Botão desabilitado em virtude de definições pendentes referentes ao editor de formulários" </small> 
                                                        </span>
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
                                            </div>
                                            
                                        {!! Form::close() !!}
                                    </div>
                                </div>


                                <div class="tab-pane active" id="verForms" role="tabpanel">
                                    <div class="p-20">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <h5 class="alert alert-info alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    Quando o campo <b>Título do Formulário</b> for preenchido, os outros filtros serão <b>ignorados</b>. Caso o campo seja deixado em branco, os outros filtros serão aplicados em conjunto.
                                                </h5>
                                            </div>
                                            <div class="row">
                                                <h4>FILTROS</h4>
                                                <div class="col-md-12">

                                                    {!! Form::open(['route' => 'formularios.filter-forms-index', 'class' => 'form-horizontal']) !!}
                                                        <div class="row margin-top-1percent">
                                                            <div class="col-md-3 margin-right-1percent">
                                                                <div class="row">
                                                                    {!! Form::select('search_grupoDivulgacao', $grupoDivulgacao, '', ['class' => 'form-control  custom-select']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 margin-right-1percent">
                                                                <div class="row">
                                                                    {!! Form::text('search_tituloFormulario', null, ['class' => 'form-control', 'placeholder' => 'Título do Formulário']) !!}
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-1 mr-4">
                                                                <a href="{{ route('formularios') }}" class="btn waves-effect waves-light btn-secondary"><i class="fa fa-ban"></i> Limpar</a>
                                                            </div>
                                                            <div class="col-md-3 margin-right-1percent">
                                                                <button type="submit" class="btn btn-block waves-effect waves-light btn-outline-success" disabled><i class="fa fa-search"></i> Buscar</button>
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
                                                                <th>Título do Formulário</th>
                                                                <th>Código</th>
                                                                <th>Status</th>
                                                                <th>Data Última Alteração</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach($formularios as $formulario)
                                                            <tr>
                                                                {{ Form::open(['route' => 'formularios.view-formulario', 'method' => 'POST']) }}
                                                                    {{ Form::hidden('formulario_id', $formulario->id) }}
                                                                    {{ Form::hidden('action', 'view') }}
                                                                    <td>
                                                                        {!! Form::submit($formulario->nome, ['class' => 'a-href-submit']) !!}
                                                                    </td>
                                                                {{ Form::close() }}

                                                                <td><span class="text-muted"><i class="fa fa-file-text-o"></i></span> {{ $formulario->codigo }} </td>

                                                                <td>
                                                                    <p class="text-muted font-weight-bold"> {{ $formulario->etapa }} </p>
                                                                </td>
                                                                <td>{{ date("d/m/Y H:i:s", strtotime($formulario->updated_at)) }}</td>
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
            </div>
            <!-- End Page Content -->


        </div>
    </div>
@endsection



@section('footer')

    <script>
        // Envia o form conforme o botão que foi clicado
        $("#importFormulario").click(function(){
            var input = $("<input>").attr("type", "hidden").attr("name", "action").val("import");
            $('#form-save-new-document').append($(input));
            $('#form-save-new-document').submit();
        });
        $("#createFormulario").click(function(){
            var input = $("<input>").attr("type", "hidden").attr("name", "action").val("create");
            $('#form-save-new-document').append($(input));
            $('#form-save-new-document').submit();
        });
    </script>

@endsection

