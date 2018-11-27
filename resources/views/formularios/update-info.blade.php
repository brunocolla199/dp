@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-9 col-9 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Visualização de Formulário</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('formularios') }}">Formulários</a></li>
                        <li class="breadcrumb-item active">Atualizar Informações</li>
                    </ol>
                </div>               
            </div>
            
            
            <!-- Start Page Content -->
            <div class="row">

                <!-- Card Principal -->
                <div class="col-12">
                    <div class="card">
                        <div class=" card-body">
                            {!! Form::open(['route' => 'formularios.update-info', 'method' => 'POST', 'id' => 'form-save-new-document']) !!}
                                {{ csrf_field() }}
                                {!! Form::hidden('form_id', $formulario->id) !!}
                                

                                <!-- Linha 1 -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label font-bold">
                                                {!! Form::label('grupoDivulgacao', 'GRUPO DE DIVULGAÇÃO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('grupoDivulgacao', $gruposDivulgacao, $formulario->grupo_divulgacao_id, ['class' => 'form-control  custom-select']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-10 control-label font-bold">
                                                {!! Form::label('nivelAcessoFormulario', 'NÍVEL DE ACESSO AO DOCUMENTO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                
                                                {!! Form::select('nivelAcessoFormulario', [Constants::$NIVEL_ACESSO_DOC_LIVRE, Constants::$NIVEL_ACESSO_DOC_RESTRITO], $formulario->nivel_acesso_fake_id, ['class' => 'form-control  custom-select']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Linha 2 -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('tituloFormulario', 'TÍTULO DO FORMULÁRIO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('tituloFormulario', $formulario->nome, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="col-md-6">
                                        <div class="col-md-12 mt-3">
                                            <button type="submit" class="btn waves-effect waves-light btn-block btn-lg btn-secondary" >ATUALIZAR INFORMAÇÕES</button>
                                        </div>
                                    </div>
                                </div>    


                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
            

        </div>
    </div>


@endsection