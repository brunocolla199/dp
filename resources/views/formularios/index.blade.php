@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Nome da Página</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Página Anterior</a></li>
                        <li class="breadcrumb-item active">Nome da Página</li>
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
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#novoForm" role="tab"><span class="hidden-xs-down">NOVO FORMULÁRIO</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#verForms" role="tab"><span class="hidden-xs-down">VISUALIZAR FORMULÁRIOS</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="novoForm" role="tabpanel">
                                    <div class="p-20">
                                        => 4 campos principais de inserção <br>
                                        => 2 botões grandes (Importar Formulário [NÃO DEVE EXISTIR]  &&  Criar Formulário)
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