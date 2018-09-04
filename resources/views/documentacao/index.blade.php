@extends('layouts.app')

@section('content')
    <!-- O que fazer nesta situação? -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"  rel="stylesheet">
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    

    @if (session('approval_success'))
		<input type="hidden" name="status" id="status" value="approval_success">
    @elseif (session('reject_success'))
        <input type="hidden" name="status" id="status" value="reject_success">
    @elseif (session('link_success'))
		<input type="hidden" name="status" id="status" value="link_success">
    @elseif (session('resend_success'))
		<input type="hidden" name="status" id="status" value="resend_success">
    @elseif (session('import_list_success'))
		<input type="hidden" name="status" id="status" value="import_list_success">
    @elseif (session('reject_list_success'))
		<input type="hidden" name="status" id="status" value="reject_list_success">
    @elseif (session('resend_list_success'))
		<input type="hidden" name="status" id="status" value="resend_list_success">
    @elseif (session('request_review_success'))
		<input type="hidden" name="status" id="status" value="request_review_success">
    @elseif (session('reject_request_review_success'))
		<input type="hidden" name="status" id="status" value="reject_request_review_success">
    @elseif (session('approves_request_review_success'))
		<input type="hidden" name="status" id="status" value="approves_request_review_success">
    @elseif (session('document_name_already_exists'))
		<input type="hidden" name="status" id="status" value="document_name_already_exists">
    @elseif (session('cancel_review_success'))
		<input type="hidden" name="status" id="status" value="cancel_review_success">
    @elseif (session('make_obsolete_doc'))
		<input type="hidden" name="status" id="status" value="make_obsolete_doc">
    @elseif (session('make_active_doc'))
		<input type="hidden" name="status" id="status" value="make_active_doc">
    @endif

    <script>
        $(document).ready(function(){
            // Verifica se acabou de gravar uma nova solicitação
            var status = $("#status").val();
            if(status == "approval_success") {
                showToast('Sucesso!', 'O documento foi aprovado.', 'success');
            } else if(status == "reject_success") {
                showToast('Sucesso!', 'O documento foi rejeitado.', 'success');
            } else if(status == "resend_success") {
                showToast('Sucesso!', 'O documento foi reenviado para a Qualidade.', 'success');
            } else if(status == "link_success") {
                showToast('Sucesso!', 'A vinculação foi realizada com sucesso.', 'success');
            } else if(status == "import_list_success") {
                showToast('Sucesso!', 'A lista de presença foi salva.', 'success');
            } else if(status == "reject_list_success") {
                showToast('Sucesso!', 'A lista de presença foi rejeitada.', 'success');
            } else if(status == "resend_list_success") {
                showToast('Sucesso!', 'A lista de presença foi reenviada ao Capital Humano.', 'success');
            } else if(status == "request_review_success") {
                showToast('Sucesso!', 'O seu pedido de revisão do documento foi enviado à Qualidade.', 'success');
            } else if(status == "reject_request_review_success") {
                showToast('Sucesso!', 'O pedido de revisão do documento foi rejeitado com sucesso.', 'success');
            } else if(status == "approves_request_review_success") {
                showToast('Sucesso!', 'O pedido de revisão do documento foi aprovado com sucesso e o workflow de revisão já está em andamento.', 'success');
            } else if(status == "document_name_already_exists") {
                showToast('Nome já existe!', 'Já existe um documento no sistema com esse mesmo nome. Por favor, escolha outro!', 'warning');
            } else if(status == "cancel_review_success") {
                showToast('Sucesso!', 'A revisão do documento foi cancelada com sucesso.', 'success');
            } else if(status == "make_obsolete_doc") {
                showToast('Sucesso!', 'O documento foi marcado como obsoleto. Você pode ativá-lo a qualquer momento!', 'success');
            } else if(status == "make_active_doc") {
                showToast('Sucesso!', 'O documento foi ativado com sucesso!', 'success');
            }
        });
    </script>



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
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-light btn-success btn btn-circle btn-xl pull-right m-l-10   btn-badge badge-top-right" data-count="{{ count(\App\Classes\Helpers::instance()->getNotifications( Auth::user()->id )) }}">
                            <i class="ti-comment-alt text-white"></i>
                        </button>
                    </div>
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
                                <li class="nav-item"> <a class="nav-link font-bold" data-toggle="tab" href="#gerarDocs" role="tab"><h3 class="hidden-xs-down">GERAR DOCUMENTOS</h3></a> </li>
                                <li class="nav-item"> <a class="nav-link font-bold active" data-toggle="tab" href="#visualizarDocs" role="tab"><h3 class="hidden-xs-down">VISUALIZAR DOCUMENTOS</h3></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <!-- 
                                    /* TAB - Gerar Documento */ 
                                -->
                                <div class="tab-pane p-20" id="gerarDocs" role="tabpanel"> 
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
                                                            {!! Form::label('aprovadores', 'APROVADORES:') !!}
                                                        </div>
                                                        <div class="col-md-12">

                                                            {!! Form::select('aprovador', $aprovadores, '', ['class' => 'form-control  custom-select', 'id' => 'aprovadores']) !!}
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
                                                            <select multiple id="optgroup-newAreaDeInteresse" name="areaInteresse[]">
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-6 control-label font-bold">
                                                            {!! Form::label('tituloDocumento', 'TÍTULO DO DOCUMENTO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::text('tituloDocumento', null, ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="col-md-10 control-label font-bold">
                                                            {!! Form::label('formulariosAtrelados', 'ATRELAR AOS FORMULÁRIOS:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            <select multiple id="optgroup-formulariosAtrelados" name="formulariosAtrelados[]" class="form-control select2" style="width:100%;">
                                                                @foreach($formularios as $key => $form)
                                                                    <option value="{{ $key }}">{{ $form }}</option>
                                                                @endforeach
                                                            </select>
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
                                                    @elseif (session('document_name_already_exists'))
                                                        <div class="alert alert-warning">
                                                            <ul>
                                                                <li>{{ session('document_name_already_exists') }}</li>
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


                                <!-- 
                                    /* TAB - Visualizar Documento */ 
                                -->
                                <div class="tab-pane active" id="visualizarDocs" role="tabpanel">
                                    <div class="p-20">
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
                                                            <div class="col-md-4" >
                                                                <div class="row ">
                                                                    {!! Form::select('search_tipoDocumento', $tipoDocumentos, null, ['class' => 'form-control  custom-select', 'style' => 'width: 96%']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" >
                                                                <div class="row">
                                                                    {!! Form::select('search_grupoDivulgacao', array(null => '- Grupo Divulgação -') + $gruposDivulgacao, null, ['class' => 'form-control  custom-select', 'style' => 'width: 96%']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" >
                                                                <div class="row ">
                                                                    {!! Form::select('search_grupoTreinamento', array(null => '- Grupo Treinamento -') + $gruposTreinamento, '', ['class' => 'form-control  custom-select', 'style' => 'width: 96%']) !!}
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <div class="row margin-top-1percent">
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    {!! Form::select('search_setor', array(null => '- Setor -') + $setores, null, ['class' => 'form-control  custom-select', 'style' => 'width: 96%']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="row">
                                                                    <div class="input-group">
                                                                        {!! Form::text('search_validadeDocumento', null, ['class' => 'form-control', 'id' => 'mdate_search', 'placeholder'=>'- Validade -', 'style' => 'width: 96%']) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="row">
                                                                    {!! Form::text('search_tituloDocumento', null, ['class' => 'form-control', 'placeholder' => '- Título do Documento -', 'style' => 'width: 93.5%; margin-left:2.5%']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row margin-top-1percent">    
                                                            <div class="col-md-6"> </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <a href="{{ route('documentacao') }}" class="btn btn-block waves-effect waves-light btn-secondary"><i class="fa fa-ban"></i> Limpar</a>
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
                                                <div class="table-responsive class="text-nowrap"">
                                                    <table class="table table-condensed" style="table-layout: fixed">
                                                        <thead>
                                                            <tr>
                                                                <th>Título do Documento</th>
                                                                <th class="text-nowrap">Código</th>
                                                                <th>Tipo do Documento</th>
                                                                <th>Status</th>
                                                                <th>Modificado</th>
                                                                <th>Validade</th>
                                                                <th class="text-nowrap text-center">Ações</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @if( $documentos_nao_finalizados != null && count($documentos_nao_finalizados) > 0 )
                                                                @foreach($documentos_nao_finalizados as $doc)
                                                                    <tr>
                                                                        {{ Form::open(['route' => 'documentacao.view-document', 'method' => 'POST']) }}
                                                                            {{ Form::hidden('document_id', $doc->id) }}
                                                                            <td>
                                                                                {!! Form::submit( explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $doc->nome)[0], ['class' => 'a-href-submit force-break-word']) !!}
                                                                            </td>
                                                                        {{ Form::close() }}

                                                                        <td class="text-nowrap"> {{ $doc->codigo }} </td>

                                                                        <td><span class="text-muted"><i class="fa fa-file-text-o"></i></span> {{ $doc->nome_tipo }} </td>
                                                                        <td>
                                                                            <p class="text-muted font-weight-bold"> {{ $doc->etapa }} </p>
                                                                        </td>
                                                                        <td>{{ date("d/m/Y H:i:s", strtotime($doc->updated_at)) }}</td>
                                                                        <td>{{ date("d/m/Y", strtotime($doc->validade)) }}</td>
                                                                        <td class="text-nowrap text-center">
                                                                            <a href="#" title="Vincular Formulários" data-forms="{{ $doc->formularios }}" data-id="{{ $doc->id }}" data-toggle="modal" data-target="#vinculos-form-modal" data-finalizado="false"><i class="fa fa-exchange text-info" data-toggle="tooltip" data-original-title="Vincular Formulários"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif

                                                            @if( $documentos_finalizados != null && count($documentos_finalizados) > 0 )
                                                                @foreach($documentos_finalizados as $docF)

                                                                    @if( $docF->obsoleto )
                                                                        <tr>
                                                                            {{ Form::open(['route' => 'documentacao.view-obsolete-doc', 'method' => 'POST']) }}
                                                                                {{ Form::hidden('document_id', $docF->id) }}
                                                                                <td>
                                                                                    {!! Form::submit(explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $docF->nome)[0], ['class' => 'a-href-submit force-break-word']) !!}
                                                                                </td>
                                                                            {{ Form::close() }}

                                                                            <td class="text-nowrap"> {{ $docF->codigo }} </td>

                                                                            <td><span class="text-muted"><i class="fa fa-file-text-o"></i></span> {{ $docF->nome_tipo }} </td>
                                                                            
                                                                            <td><p class="font-weight-bold text-danger"> Obsoleto </p></td>

                                                                            <td>{{ date("d/m/Y H:i:s", strtotime($docF->updated_at)) }}</td>

                                                                            <td>{{ date("d/m/Y", strtotime($docF->validade)) }}</td>
                                                                            
                                                                            <td class="text-nowrap text-center">
                                                                                @if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                                                                    <a href="javascript:void(0)" class="btn-ativar-documento-modal ml-3" data-id="{{ $docF->id }}"> <i class="fa fa-power-off text-success" data-toggle="tooltip" data-original-title="Ativar Documento"></i> </a> 
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @elseif( !$docF->obsoleto )
                                                                        <tr>
                                                                            {{ Form::open(['route' => 'documentacao.view-document', 'method' => 'POST']) }}
                                                                                {{ Form::hidden('document_id', $docF->id) }}
                                                                                <td>
                                                                                    {!! Form::submit(explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $docF->nome)[0], ['class' => 'a-href-submit force-break-word']) !!}
                                                                                </td>
                                                                            {{ Form::close() }}

                                                                            <td class="text-nowrap"> {{ $docF->codigo }} </td>

                                                                            <td><span class="text-muted"><i class="fa fa-file-text-o"></i></span> {{ $docF->nome_tipo }} </td>

                                                                            <td><p class="text-muted font-weight-bold text-success"> Finalizado </p> </td>

                                                                            <td>{{ date("d/m/Y H:i:s", strtotime($docF->updated_at)) }}</td>
                                                                            <td>{{ date("d/m/Y", strtotime($docF->validade)) }}</td>
                                                                            
                                                                            <td class="text-nowrap text-center">
                                                                                <a href="#" class="{{ (!$docF->necessita_revisao) ? 'm-r-15' : '' }}" data-forms="{{ $docF->formularios }}" data-id="{{ $docF->id }}" data-toggle="modal" data-target="#vinculos-form-modal" data-finalizado="true"><i class="fa fa-exchange text-info" data-toggle="tooltip" data-original-title="Vincular Formulários"></i></a>

                                                                                @if( !$docF->necessita_revisao )
                                                                                    <a href="javascript:void(0)" class="btn-open-confirm-review" data-id="{{ $docF->id }}"> <i class="fa fa-eye text-warning" data-toggle="tooltip" data-original-title="Solicitar Revisão"></i> </a>
                                                                                @endif

                                                                                @if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                                                                    <a href="javascript:void(0)" class="btn-tornar-documento-obsoleto-modal ml-3" data-id="{{ $docF->id }}"> <i class="fa fa-power-off text-danger" data-toggle="tooltip" data-original-title="Tornar Obsoleto"></i> </a> 
                                                                                @endif
                                                                            </td>
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
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
            
            <!-- Modal para vínculos com formulários -->
            <div id="vinculos-form-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    
                    {{ Form::open(['route' => 'documentacao.save-link-form', 'id' => 'save-link-form', 'method' => 'POST']) }}
                        
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Vinculação de Formulários</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12 control-label font-bold">
                                        {!! Form::label('formulariosAtrelados', 'ATRELAR AOS FORMULÁRIOS:') !!}
                                    </div>
                                    <div class="col-md-12">
                                        <select multiple name="formulariosAtreladosDocs[]" class="form-control select2-vinculos" style="width:100%;">
                                            @foreach($formularios as $key => $form)
                                                <option value="{{ $key }}" >{{ $form }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn-save-link btn btn-success waves-effect" >Salvar Vínculos </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.modal para vínculos com formulários -->


            <!-- Modal de confirmação - deseja mesmo solicitar uma revisão neste documento -->
            <div class="modal fade bs-example-modal-sm" id="solicitar-revisao-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body"> 
                            Deseja solicitar uma revisão neste documento? 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>

                            {{ Form::open(['route' => 'documentacao.request-review', 'method' => 'POST']) }}
                                {{ Form::hidden('document_id', '', ['id' => 'document_id_request_review']) }}
                                <button type="submit" class="btn btn-success waves-effect"> Sim </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.Modal de confirmação - deseja mesmo solicitar uma revisão neste documento -->


            <!-- Modal de confirmação - deseja mesmo tornar o documento obsoleto -->
            <div class="modal fade" id="tornar-documento-obsoleto-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body"> 
                            Tem certeza que deseja tornar o documento obsoleto? 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>

                            {{ Form::open(['route' => 'documentacao.make-obsolete-doc', 'method' => 'POST']) }}
                                {{ Form::hidden('doc_id', '', ['id' => 'form_id_make_obsolete_doc']) }}
                                <button type="submit" class="btn btn-success waves-effect"> Sim </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.Modal de confirmação - deseja mesmo tornar o documento obsoleto -->
            
            <!-- Modal de confirmação - deseja mesmo ativar o documento -->
            <div class="modal fade" id="ativar-documento-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body"> 
                            Tem certeza que deseja ativar o documento ? 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Não</button>

                            {{ Form::open(['route' => 'documentacao.make-active-doc', 'method' => 'POST']) }}
                                {{ Form::hidden('doc_id', '', ['id' => 'form_id_make_active_doc']) }}
                                <button type="submit" class="btn btn-success waves-effect"> Sim </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.Modal de confirmação - deseja mesmo ativar o documento -->


            <script>

                // Material Date picker   
                $('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: new Date(), lang: 'pt-br', format: 'DD/M/YYYY', currentDate: new Date(), cancelText: 'Cancelar', okText: 'Definir' });
                $('#mdate_search').bootstrapMaterialDatePicker({ weekStart : 0, time: false, lang: 'pt-br', format: 'DD/M/YYYY',  cancelText: 'Cancelar', okText: 'Definir' }); //currentDate: new Date(),

                /*
                *   QUANDO CARREGAR A PÁGINA
                */
                $(document).ready(function(){
                    /*
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
                    */

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

                    // Mudanças no select de setor dono do documento
                    $("#setor_dono_doc").change(function(){
                        var obj = {'id': $("#setor_dono_doc").val()};

                        ajaxMethod('POST', " {{ URL::route('ajax.usuarios.aprovadoresPorSetor') }} ", obj).then(function(result) {
                            var data = result.response;
                            $("#aprovadores").empty();

                            if(Object.keys(data).length > 0 ) {    
                                Object.keys(data).forEach(function(key) {
                                    $('#aprovadores').append($('<option>', { 
                                        value: key,
                                        text : data[key]
                                    }));
                                });
                            }

                        }, function(err) {
                        });
                    });

                    // Chama trigger quando a página é recarregada
                    $("#setor_dono_doc").val( $("#setor_dono_doc").val() ).trigger("change");

                    // Ao clicar no botão que abrirá o modal de confirmação para revisão do documento
                    $(".btn-open-confirm-review").click(function(){
                        var id = $(this).data('id');
                        $("#document_id_request_review").val(id);
                        
                        $("#solicitar-revisao-modal").modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                    });

                    // Ao clicar no botão que abrirá o modal de confirmação para tornar o formulário obsoleto
                    $(".btn-tornar-documento-obsoleto-modal").click(function(){
                        var id = $(this).data('id');
                        $("#form_id_make_obsolete_doc").val(id);
                        
                        $("#tornar-documento-obsoleto-modal").modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                    });

                    // Ao clicar no botão que abrirá o modal de confirmação para ativar o formulário 
                    $(".btn-ativar-documento-modal").click(function(){
                        var id = $(this).data('id');
                        $("#form_id_make_active_doc").val(id);
                        
                        $("#ativar-documento-modal").modal({
                            backdrop: 'static',
                            keyboard: false
                        });
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


    <!-- Formulário para visualizar o formulário ( dafuk ?????? )  -->
    {{ Form::open(['route' => 'formularios.view-formulario', 'target'=>'_blank', 'id'=>'form-view-formulario', 'method' => 'POST']) }}
        {{ Form::hidden('action', 'view') }}
    {{ Form::close() }}


@endsection


@section('footer')
    <script src="{{ asset('plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('plugins/quicksearch/jquery.quicksearch.js') }}"></script>
    <script>
        
        function viewFormulario(id){
            $("#form-view-formulario").append("<input type='hidden' name='formulario_id' value="+id+" >");
            $("#form-view-formulario").submit();
        }
        
        $(function(){
            /*
            * 
            * MultiSelect de NOVA ÁREA DE INTERESSE
            *
            */
            $('#optgroup-newAreaDeInteresse').multiSelect({
                selectableOptgroup: true,
                selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Pesquisar usuários'>",
                selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Pesquisar usuários'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                    if (e.which === 40){
                        that.$selectableUl.focus();
                        return false;
                    }
                    });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                    if (e.which == 40){
                        that.$selectionUl.focus();
                        return false;
                    }
                    });
                },
                afterSelect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function(values){
                    this.qs1.cache();
                    this.qs2.cache();
                }
            });


            $("[data-target='#vinculos-form-modal']").click(function(){
                var forms = JSON.parse($(this).attr('data-forms'));
                var id = $(this).attr('data-id');
                var status = $(this).attr('data-finalizado');

                $("#save-link-form").append("<input type='hidden' name='documento_id' value='"+id+"' >")
                var select = $(".select2-vinculos").select2({
                    templateSelection: function (d) { 
                        return $('<a href="#" onclick="viewFormulario('+d.id+')" ><b>'+d.text+'</b></a>'); 
                    },
                });
                select.val(forms);
                select.trigger('change');   
            });
            
            $(".btn-save-link").click(function(){
                $("#save-link-form").submit();
            });

        });
    </script>
@endsection
