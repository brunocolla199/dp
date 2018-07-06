@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Formulários</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active">Formulários</li>
                    </ol>
                </div>
            </div>
            
            
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
							 <!-- Nav tabs -->
                             <ul class="nav nav-tabs nav-fill customtab" role="tablist">
                                <li class="nav-item"> <a class="nav-link font-bold active" data-toggle="tab" href="#novoForm" role="tab"><h3 class="hidden-xs-down">NOVO FORMULÁRIO</h3></a> </li>
                                <li class="nav-item"> <a class="nav-link font-bold" data-toggle="tab" href="#verForms" role="tab"><h3 class="hidden-xs-down">VISUALIZAR FORMULÁRIOS</h3></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="novoForm" role="tabpanel">
                                    <div class="p-20">
                                        <div class="col-md-12">
                                        {!! Form::open(['route' => 'home', 'class' => 'form-horizontal']) !!}
                                                <!-- Linha 1 -->
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="col-md-6 control-label font-bold">
                                                                {!! Form::label('area', 'ÁREA:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('area', ['-- Selecione --', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="col-md-12 control-label font-bold">
                                                                {!! Form::label('documentoVinculado', 'ATRELADO AO DOCUMENTO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('documentoVinculado', ['-- Selecione --', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="col-md-12 control-label font-bold">
                                                                {!! Form::label('grupoDivulgacao', 'GRUPO DE DIVULGAÇÃO:') !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                {!! Form::select('grupoDivulgacao', ['-- Selecione --', 'Opção 1', 'Opção 2', 'Opção 3'], '', ['class' => 'form-control  custom-select']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Linha 2 -->
                                                <div class="row">
                                                    <div class="col-md-12">
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

                                                <!-- Linha 3 -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">IMPORTAR FORMULÁRIO</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">CRIAR FORMULÁRIO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane  p-20" id="verForms" role="tabpanel">
                                    => 2 Linhas de filtros <br>
                                    => 1 tabela abaixo <br> 
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