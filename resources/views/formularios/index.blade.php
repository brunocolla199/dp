@extends('layouts.app')

@section('content')

    @if (session('approval_success'))
		<input type="hidden" name="status" id="status" value="approval_success">
    @elseif (session('reject_success'))
		<input type="hidden" name="status" id="status" value="reject_success">
    @elseif (session('resend_success'))
		<input type="hidden" name="status" id="status" value="resend_success">
    @elseif (session('start_review_success'))
		<input type="hidden" name="status" id="status" value="start_review_success">
    @elseif (session('send_new_review_success'))
		<input type="hidden" name="status" id="status" value="send_new_review_success">
    @elseif (session('cancel_review_success'))
		<input type="hidden" name="status" id="status" value="cancel_review_success">
    @elseif (session('make_obsolete_form'))
		<input type="hidden" name="status" id="status" value="make_obsolete_form">
    @elseif (session('make_active_form'))
		<input type="hidden" name="status" id="status" value="make_active_form">
    @endif

    <script>
        $(document).ready(function(){
            // Verifica se acabou de gravar uma nova solicitação
            var status = $("#status").val();
            if(status == "approval_success") {
                showToast('Sucesso!', 'O Formulário foi aprovado.', 'success');
            } else if(status == "reject_success") {
                showToast('Sucesso!', 'O Formulário foi rejeitado.', 'success');
            } else if(status == "resend_success") {
                showToast('Sucesso!', 'O Formulário foi reenviado para a Qualidade.', 'success');
            } else if(status == "start_review_success") {
                showToast('Sucesso!', 'A revisão do formulário foi iniciada.', 'success');
            } else if(status == "send_new_review_success") {
                showToast('Sucesso!', 'A nova revisão do formulário foi enviada para a Qualidade.', 'success');
            } else if(status == "cancel_review_success") {
                showToast('Sucesso!', 'Revisão cancelada. Versão anterior do formulário restaurada com sucesso.', 'success');
            } else if(status == "make_obsolete_form") {
                showToast('Sucesso!', 'O formulário foi marcado como obsoleto. Você pode ativá-lo a qualquer momento!', 'success');
            } else if(status == "make_active_form") {
                showToast('Sucesso!', 'O formulário foi ativado com sucesso!', 'success');
            } 
        });
    </script>


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
                        <button class="right-side-toggle waves-light btn-success btn btn-circle btn-xl pull-right m-l-10   btn-badge badge-top-right" data-count="{{ count(\App\Classes\Helpers::instance()->getNotifications( Auth::user()->id )) }}">
                            <i class="ti-comment-alt text-white"></i>
                        </button>
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
                                                            {!! Form::select('setor_dono_form', $setorUsuarioAtual, '', ['class' => 'form-control  custom-select']) !!}
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

                                            <!-- Linha 3 -->
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

                                                    {!! Form::open(['route' => 'formularios.filter-forms-index', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                                                        <div class="row margin-top-1percent">
                                                            <div class="col-md-3 margin-right-1percent">
                                                                <div class="row">
                                                                    {!! Form::select('search_grupoDivulgacao', array(null => '- Grupo Divulgação -') + $grupoDivulgacao, null, ['class' => 'form-control  custom-select']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 margin-right-1percent">
                                                                <div class="row">
                                                                    {!! Form::select('search_setor', array(null => '- Setor -') + $setores, null, ['class' => 'form-control  custom-select']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 margin-right-1percent">
                                                                <div class="row">
                                                                    {!! Form::text('search_tituloFormulario', null, ['class' => 'form-control', 'placeholder' => 'Título do Formulário']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row margin-top-1percent">    
                                                            <div class="col-md-6"> </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <a href="{{ route('formularios') }}" class="btn btn-block waves-effect waves-light btn-secondary"><i class="fa fa-ban"></i> Limpar</a>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <button type="submit" class="btn btn-block waves-effect waves-light btn-outline-success"><i class="fa fa-search"></i> Buscar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    {!! Form::close() !!} 
                                                    
                                                </div>
                                            </div>

                                            <div class="row mt-5 margin-top-1percent">
                                                <div class="table-responsive">
                                                    <table class="table" style="table-layout: fixed">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-nowrap text-center">Ações</th>
                                                                <th>Título do Formulário</th>
                                                                <th>Código</th>
                                                                <th class="text-nowrap text-center">Revisão</th>
                                                                <th>Status</th>
                                                                <th class="text-center">Data Emissão</th>
                                                                <th class="text-center">Modificado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @if( is_array($formularios) && array_key_exists("nao_finalizados", $formularios) && count($formularios['nao_finalizados']) > 0 )
                                                                @foreach($formularios['nao_finalizados'] as $form)
                                                                    <tr>
                                                                        <td class="text-nowrap text-center"></td>

                                                                        {{ Form::open(['route' => 'formularios.view-formulario', 'method' => 'POST']) }}
                                                                            {{ Form::hidden('formulario_id', $form->id) }}
                                                                            {{ Form::hidden('action', 'view') }}
                                                                            <td>
                                                                                {!! Form::submit($form->nome, ['class' => 'a-href-submit force-break-word']) !!}
                                                                            </td>
                                                                        {{ Form::close() }}

                                                                        <td><span class="text-muted"><i class="fa fa-file-text-o"></i></span> {{ $form->codigo }} </td>
                                                                        
                                                                        <td><p class="text-nowrap text-center"> {{ $form->revisao }} </p></td>

                                                                        <td><p class="text-muted font-weight-bold"> {{ $form->etapa }} </p></td>
                                                                        
                                                                        <td><p class="text-center"> {{ date("d/m/Y H:i:s", strtotime($form->created_at)) }} </p></td>
                                                                        
                                                                        <td class="text-center">{{ date("d/m/Y H:i:s", strtotime($form->updated_at)) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif

                                                            @if( is_array($formularios) && array_key_exists("finalizados", $formularios) && count($formularios['finalizados']) > 0 )
                                                                @foreach($formularios['finalizados'] as $form)

                                                                    @if( $form->obsoleto && Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                                                        <tr>
                                                                            <td class="text-nowrap text-center"> 
                                                                                <a href="javascript:void(0)" class="btn-ativar-formulario-modal ml-3" data-id="{{ $form->id }}"> <i class="fa fa-power-off text-success fa-2x" data-toggle="tooltip" data-original-title="Ativar Formulário"></i> </a> 
                                                                            </td>

                                                                            {{ Form::open(['route' => 'formularios.view-obsolete-form', 'method' => 'POST']) }}
                                                                                {{ Form::hidden('formulario_id', $form->id) }}
                                                                                <td>
                                                                                    {!! Form::submit($form->nome, ['class' => 'a-href-submit force-break-word']) !!}
                                                                                </td>
                                                                            {{ Form::close() }}

                                                                            <td><span class="text-muted"><i class="fa fa-file-text-o"></i></span> {{ $form->codigo }} </td>

                                                                            <td><p class="text-nowrap text-center"> {{ $form->revisao }} </p></td>

                                                                            <td><p class="font-weight-bold text-danger"> Obsoleto </p></td>
                                                                            
                                                                            <td><p class="text-center"> {{ date("d/m/Y H:i:s", strtotime($form->created_at)) }} </p></td>

                                                                            <td class="text-center">{{ date("d/m/Y H:i:s", strtotime($form->updated_at)) }}</td>
                                                                        </tr>
                                                                    @elseif( !$form->obsoleto )
                                                                        <tr>
                                                                            <td class="text-nowrap text-center"> 
                                                                                <a href="javascript:void(0)" class="btn-open-confirm-form-review" data-id="{{ $form->id }}"> <i class="fa fa-eye text-warning fa-2x" data-toggle="tooltip" data-original-title="Solicitar Revisão"></i> </a> 

                                                                                @if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                                                                    <a href="javascript:void(0)" class="btn-tornar-formulario-obsoleto-modal ml-3" data-id="{{ $form->id }}"> <i class="fa fa-power-off text-danger fa-2x" data-toggle="tooltip" data-original-title="Tornar Obsoleto"></i> </a> 
                                                                                @endif
                                                                            </td>
                                                                            
                                                                            {{ Form::open(['route' => 'formularios.view-formulario', 'method' => 'POST']) }}
                                                                                {{ Form::hidden('formulario_id', $form->id) }}
                                                                                {{ Form::hidden('action', 'view') }}
                                                                                <td>
                                                                                    {!! Form::submit($form->nome, ['class' => 'a-href-submit force-break-word']) !!}
                                                                                </td>
                                                                            {{ Form::close() }}

                                                                            <td><span class="text-muted"><i class="fa fa-file-text-o"></i></span> {{ $form->codigo }} </td>

                                                                            <td><p class="text-nowrap text-center"> {{ $form->revisao }} </p></td>

                                                                            <td><p class="font-weight-bold text-success"> Finalizado </p></td>
                                                                            
                                                                            <td><p class="text-center"> {{ date("d/m/Y H:i:s", strtotime($form->created_at)) }} </p></td>
                                                                            
                                                                            <td class="text-center">{{ date("d/m/Y H:i:s", strtotime($form->updated_at)) }}</td>
                                                                        </tr>
                                                                    @endif

                                                                @endforeach
                                                            @endif                                                            

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


            <!-- Modal de confirmação - deseja mesmo solicitar uma revisão neste formulário -->
            <div class="modal fade bs-example-modal-sm" id="solicitar-revisao-formulario-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body"> 
                            Deseja solicitar uma revisão neste formulário? 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>

                            {{ Form::open(['route' => 'formularios.start-review', 'method' => 'POST']) }}
                                {{ Form::hidden('form_id', '', ['id' => 'form_id_request_review']) }}
                                <button type="submit" class="btn btn-success waves-effect"> Sim </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.Modal de confirmação - deseja mesmo solicitar uma revisão neste formulário -->

            <!-- Modal de confirmação - deseja mesmo tornar o formulário obsoleto -->
            <div class="modal fade" id="tornar-formulario-obsoleto-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body"> 
                            Tem certeza que deseja tornar o formulário obsoleto? 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>

                            {{ Form::open(['route' => 'formularios.make-obsolete-form', 'method' => 'POST']) }}
                                {{ Form::hidden('form_id', '', ['id' => 'form_id_make_obsolete_form']) }}
                                <button type="submit" class="btn btn-success waves-effect"> Sim </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.Modal de confirmação - deseja mesmo tornar o formulário obsoleto -->
            
            <!-- Modal de confirmação - deseja mesmo ativar o formulário -->
            <div class="modal fade" id="ativar-formulario-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body"> 
                            Tem certeza que deseja ativar o formulário ? 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>

                            {{ Form::open(['route' => 'formularios.make-active-form', 'method' => 'POST']) }}
                                {{ Form::hidden('form_id', '', ['id' => 'form_id_make_active_form']) }}
                                <button type="submit" class="btn btn-success waves-effect"> Sim </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.Modal de confirmação - deseja mesmo ativar o formulário -->


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

        // Ao clicar no botão que abrirá o modal de confirmação para revisão do formulário
        $(".btn-open-confirm-form-review").click(function(){
            var id = $(this).data('id');
            $("#form_id_request_review").val(id);
            
            $("#solicitar-revisao-formulario-modal").modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        // Ao clicar no botão que abrirá o modal de confirmação para tornar o formulário obsoleto
        $(".btn-tornar-formulario-obsoleto-modal").click(function(){
            var id = $(this).data('id');
            $("#form_id_make_obsolete_form").val(id);
            
            $("#tornar-formulario-obsoleto-modal").modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        // Ao clicar no botão que abrirá o modal de confirmação para ativar o formulário 
        $(".btn-ativar-formulario-modal").click(function(){
            var id = $(this).data('id');
            $("#form_id_make_active_form").val(id);
            
            $("#ativar-formulario-modal").modal({
                backdrop: 'static',
                keyboard: false
            });
        });
    </script>

@endsection

