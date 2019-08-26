@extends('layouts.app')

@section('content')

    <!-- O que fazer nestas situações? -->
    
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}">



	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                
                <div class="col-md-6 col-6 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Visualização de Formulário</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('formularios') }}">Formulários</a></li>
                        <li class="breadcrumb-item active">Visualização de Formulário</li>
                    </ol>
                </div>

                <div class="col-3">
                    <button class="btn btn-lg btn-info" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Ver Linha do Tempo</button>
                </div>
                
                <?php $revisoes = \App\Classes\Helpers::instance()->getNameListAllFormRevisions($formulario_id); ?>
                @if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE  &&  count($revisoes) > 1)
                    <div class="col-3">
                        <button class="btn btn-lg btn-warning" id="btnRevisoesForm" type="button" data-toggle="collapse" data-target="#revisoesForm" aria-expanded="false" aria-controls="revisoesForm">Revisões Anteriores</button>
                    </div>
                @endif                

            </div>
            
            
            <!-- Start Page Content -->
            <div class="row">

                <!-- Card Aviso - Em Revisão -->
                @if($em_revisao)
                    <div class="col-md-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Este formulário está em revisão</h4>
                            </div>
                            @if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE)
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p class="card-text">Você pode cancelar a revisão à qualquer momento clicando no botão ao lado.</p>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#confirm-cancel-form-review-modal" data-backdrop="static">Cancelar Revisão</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Card Principal -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- Timeline do Formulário -->
                            <div class="row">
                                <div class="col col-centered">
                                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                                        <div class="card card-body text-center">

                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-6">
                                                    <div class="row" style="font-size:14px">
                                                        <div class="form-group col-md-12">
                                                            
                                                            <!-- INICIO TIMELINE FORMS -->
                                                            <?php \Carbon\Carbon::setLocale('pt_BR') ?>
                                                            
                                                            <ul class="timeline">
                                                                
                                                            @foreach($historico as $key => $hist)
                                                                <li class=" {{ $key%2 == 0 ? 'timeline-inverted' : '' }}">
                                                                    <div class="timeline-badge {{ ($loop->last && $hist->finalizado) ? 'icon-green' : 'success'}} "  >
                                                                        <!-- <i class="mdi {{ ($hist->finalizado == 'true') ? 'mdi-check-circle-outline' : 'mdi-file-document' }}"></i>  ESSE TA CERTO, MAS PRECISA SALVAR A ETAPA-->
                                                                        
                                                                        @if ($loop->last && $hist->finalizado)
                                                                            <i class="mdi mdi-check-circle-outline"></i>
                                                                        @else
                                                                            <i class="mdi mdi-file-document"></i>
                                                                        @endif

                                                                    </div>
                                                                    <div class="timeline-panel">
                                                                        <div class="timeline-heading">
                                                                            <h4 class="timeline-title">{{ ($hist->nome_usuario_responsavel != null) ? $hist->nome_usuario_responsavel : 'Usuário Inválido' }}</h4>
                                                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{ $hist->created_at->diffForHumans() }}</small> </p>
                                                                        </div>
                                                                        <div class="timeline-body">
                                                                            <p>{{ $hist->descricao }}</p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                                    
                                                            </ul>
                                                                                                            
                                                            <!-- END TIMELINE FORMS -->

                                                        </div>
                                                    </div>
                                                </div>    
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Revisões do Formulário -->
                            @if( Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE  &&  count($revisoes) > 1)
                                <div class="row">
                                    <div class="col col-centered">
                                        <div class="collapse multi-collapse" id="revisoesForm">
                                            <div class="card card-body text-center">

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 p-20">
                                                        <h3 class="card-title text-success">Revisões do formulário: <b>{{ explode('_rev', $nome)[0] }}</b></h3>
                                                        <div class="list-group" id="reviews-list-div">
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif        


                            <!-- Div com os botões de aprovar ou rejeitar || Opções etapa Elaborador -->
                            @if( $etapa_form == Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM && $elaborador_id == Auth::user()->id) 
                               
                                @if($justificativaRejeicaoForm != null  &&  $justificativaRejeicaoForm != "")

                                    {{ Form::open(['route' => 'formularios.resend-form', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="col-md-12">
                                                    <div class="row card">
                                                        <div class="card-body">
                                                            <h4 class="card-title"> Upload de formulário corrigido </h4>
                                                            <label for="input-file-now">Por favor, anexe a versão corrigida do formulário  <b>{{ $nome }}</b> .</label>                                                            
                                                            {!! Form::file('new_form', ['class' => 'dropify', 'id' => 'new_form', 'data-allowed-file-extensions'=>'doc docx xlsx xls', 'required' => 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-4">
                                                <div class="ribbon-wrapper card ">
                                                    <div class="ribbon ribbon-bookmark ribbon-danger">JUSTIFICATIVA DE REJEIÇÃO</div> 
                                                    <p class="ribbon-content"> {{ $justificativaRejeicaoForm }} </p>
                                                </div>
                                                <div class="col-md-12 pull-right">    
                                                    {{ Form::hidden('formulario_id', $formulario_id) }}
                                                    {{ Form::hidden('etapa_form', $etapa_form) }}
                                                    {!! Form::button('Encaminhar para validação/aprovação <i class="fa fa-send"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success pull-right'] )  !!}
                                                </div>
                                            </div>    
                                        </div>
                                    {{ Form::close() }}

                                @elseif($justificativaRejeicaoForm == "" && $em_revisao)

                                    {{ Form::open(['route' => 'formularios.send-new-review', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'form-new-review']) }}
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="col-md-12">
                                                    <div class="row card">
                                                        <div class="card-body">
                                                            <h4 class="card-title"> Upload da nova revisão do formulário </h4>
                                                            <label for="input-file-now">Por favor, anexe a nova revisão do formulário  <b>{{ explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $nome)[0] }}</b> .</label>                                                            
                                                            {!! Form::file('new_review_form', ['class' => 'dropify', 'id' => 'new_review_form', 'data-allowed-file-extensions'=>'pdf doc docx xlsx xls', 'required' => 'required']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-4">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <h6 class="alert alert-warning alert-dismissible text-center" role="alert">
                                                            Para alterar as informações do formulário, modifique os campos abaixo!
                                                        </h6>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="col-md-12 control-label font-bold">
                                                            {!! Form::label('newTituloFormulario', 'TÍTULO DO FORMULÁRIO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::text('newTituloFormulario', explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $nome)[0], ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="col-md-12 control-label font-bold">
                                                            {!! Form::label('newCodigoFormulario', 'CÓDIGO DO FORMULÁRIO:') !!}
                                                        </div>
                                                        <div class="col-md-12">
                                                            {!! Form::text('newCodigoFormulario', $codigo, ['class' => 'form-control']) !!}
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-12 pull-right">    
                                                    {{ Form::hidden('formulario_id', $formulario_id) }}
                                                    {{ Form::hidden('etapa_form', $etapa_form) }}
                                                    {!! Form::button('ENVIAR <i class="fa fa-send"></i>', ['id' => 'btn-send-new-review', 'class' => 'btn btn-lg btn-success pull-right'] )  !!}
                                                </div>
                                            </div>    
                                        </div>
                                    {{ Form::close() }}

                                @endif

                            @elseif( $etapa_form == Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM && !$finalizado && Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE)
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-5 mr-4">
                                                <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm">REJEITAR <i class="fa fa-remove"></i></button>
                                            </div>
                                            <div class="col-md-5">    
                                                {{ Form::open(['route' => 'formularios.approval-form', 'method' => 'POST']) }}
                                                    {{ Form::hidden('formulario_id', $formulario_id) }}
                                                    {{ Form::hidden('etapa_form', $etapa_form) }}

                                                    @if( $em_revisao )
                                                        {{ Form::hidden('aprovacao_revisao', "aprovar") }}
                                                    @endif

                                                    {!! Form::button('APROVAR <i class="fa fa-check"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  !!}
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <!-- Justificativa para o cancelamento da revisão -->
                            @if(Auth::user()->id == $id_usuario_solicitante  &&  $finalizado  &&  $justificativa_cancelar_revisao != null)
                                <div class="col-md-12" id="justification-cancel-form-review-div">
                                    <div class="row text-center">
                                        <div class="col-md-9">  
                                            <div class="ribbon-wrapper card ">
                                                <div class="ribbon ribbon-bookmark ribbon-danger">JUSTIFICATIVA DE CANCELAMENTO DA REVISÃO</div> 
                                                <p class="ribbon-content"><b>Processos:</b> {{ $justificativa_cancelar_revisao }} </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3 d-flex flex-column">    
                                            <button type="button" id="ok-justify-form-review-cancel" class="btn btn-block btn-lg btn-secondary mt-3">Ok, entendi</button>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            <div class="col-md-12 text-right">
                                <a href="{{ asset('plugins/onlyoffice-php/Storage/formularios').'/'.$filePath }}" target="_blank" id="down-doc" class="btn col-md-2 btn-info"> <i class="mdi mdi-cloud-download"></i> Download</a>
                            </div>
                            <br>

                            <div class="col-md-12">
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12 control-label font-bold">
                                                {!! Form::label('tituloFormulario', 'TÍTULO DO FORMULÁRIO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('tituloFormulario', explode("_rev", $nome)[0], ['class' => 'form-control', 'readonly']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    
                                    @if ( $etapa_form == Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM  &&  Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                    
                                        <div class="col-md-2"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12 control-label font-bold">
                                                    {!! Form::label('codigoFormulario', 'CÓDIGO DO FORMULÁRIO:') !!}
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        {!! Form::text('codigoFormulario', $codigo, ['class' => 'form-control', 'id' => 'input-update-code']) !!}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button class="btn btn-block btn-info" id="btn-update-code" data-form-id="{{ $formulario_id }}"><i class="mdi mdi-pencil"></i> Alterar Código</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12 control-label font-bold">
                                                    {!! Form::label('codigoFormulario', 'CÓDIGO DO FORMULÁRIO:') !!}
                                                </div>
                                                <div class="col-md-12">
                                                    {!! Form::text('codigoFormulario', $codigo, ['class' => 'form-control', 'readonly']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="iframe_box">
                                        @if(Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE  &&  !$finalizado  )
                                            <iframe src="" data-src="{{ asset('plugins/onlyoffice-php/doceditor.php?type=desktop&folder=formularios&fileID=').$filePath }}" style="width:100%; min-height:800px;" frameborder="0"></iframe>
                                        @else
                                            <iframe src="" data-src="{{ asset('plugins/onlyoffice-php/doceditor.php?type=desktop&action=review&folder=formularios&fileID=').$filePath }}" style="width:100%; min-height:800px;" frameborder="0"></iframe>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <br>
                                <div class="col-md-offset-2 col-md-3 pull-right">
                                    <button type="button" class="btn waves-effect waves-light btn-block btn-lg btn-secondary" onclick="history.back()">Voltar</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            

        </div>
    </div>




    <!-- modal justificativa reprovação do documento -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Rejeitar Formulário</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                {{ Form::open(['route' => 'formularios.reject-form', 'method' => 'POST']) }}
                    {{ Form::hidden('formulario_id', $formulario_id) }}
                    {{ Form::hidden('etapa_form', $etapa_form) }}
                    <div class="modal-body"> 
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 control-label font-bold">
                                    {!! Form::label('justificativaReprovacaoForm', 'JUSTIFICATIVA:') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Form::textarea('justificativaReprovacaoForm', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary waves-effect" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger waves-effect">Rejeitar</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal justificativa reprovação do documento -->

    <!-- modal para prévisualizar formulário -->
    <div id="preview-form-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pré-Visualização de Formulário</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="render-form"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal para prévisualizar formulário -->


    <!-- Modal de confirmação - deseja mesmo cancelar a revisão do documento -->
    <div class="modal fade " id="confirm-cancel-form-review-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Cancelar revisão</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="cursor: pointer">×</button>
                </div>
                {{ Form::open(['route' => 'formularios.cancel-review', 'method' => 'POST']) }}
                    {{ Form::hidden('formulario_id', $formulario_id) }}
                    <div class="modal-body"> 
                        Deseja, realmente, reverter todas alterações realizadas e cancelar a revisão deste formulário ?
                        <div class="row mt-3">
                            <div class="form-group">
                                <div class="col-md-12 control-label font-bold">
                                    {!! Form::label('justificativaCancelamentoRevisaoForm', 'JUSTIFICATIVA:') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Form::textarea('justificativaCancelamentoRevisaoForm', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary waves-effect" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger waves-effect">Rejeitar</button>
                    </div>
                {{ Form::close() }}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.Modal de confirmação - deseja mesmo cancelar a revisão do documento -->

@endsection

@section('footer')
<script src="{{ asset('plugins/blockUI/jquery.blockUI.js') }}"></script>
<script>
    
    // initFormeo('{!! $formData  !!}', '{{ url("/") }}');
    $("#btn-save-form").click(function(){
        var formData = JSON.stringify(window.sessionStorage.getItem('formData'));
        $("#form-edit-form").append("<input type='hidden' name='formData' value='"+formData+"' >")
        $("#form-edit-form").submit();
    });

    // Quando o botão de atualizar o código do formulário é clicado
    $("#btn-update-code").click(function(){
        let form_id = $(this).data('form-id');
        let newCode = $('#input-update-code').val();
        
        var obj = {'form_id': form_id, 'new_code': newCode};
        ajaxMethod('POST', " {{ URL::route('ajax.formularios.updateCode') }} ", obj).then(function(result) {
            if(result.response === 'success') {
                showToast("Sucesso!", "O código do formulário foi atualizado com sucesso.", 'success');
            } else {
                if( 'errorInfo' in result.response && result.response.errorInfo[0] === "23505" ) showToast('Opa!', 'Já existe um formulário utilizando esse código!', 'error');
                else showToast('Opa!', 'Não conseguimos verificar se existe um formulário com esse código. Por favor, contate o suporte técnico!', 'warning');
            }
        }, function(err) {
            console.log(err);
        });
    });

    // Quando o solicitante da revisão do formulário aceitar a justificativa de cancelamento da mesma
    $("#ok-justify-form-review-cancel").click(function() {
        var form_id = "{{$formulario_id}}";
        
        var obj = {'form_id': form_id};        
        ajaxMethod('POST', " {{ URL::route('ajax.formularios.okJustifyCancelFormReviewRequest') }} ", obj).then(function(result) {
            $("#justification-cancel-form-review-div").hide(1000);
        }, function(err) {
        });
    });

    // Toda vez que a listagem de revicões do formulário for aberta
    $('#btnRevisoesForm').click(function () {
        var form_id = "{{$formulario_id}}";
        var obj = {'form_id': form_id};        
        ajaxMethod('POST', " {{ URL::route('ajax.formularios.getFilesFormRevisions') }} ", obj).then(function(result) {
            $("#reviews-list-div").empty();
            var data = result.response;
            console.log(data);
            
            data.forEach(function(key) {
                var a = '<a href="';
                a += '{{ asset("plugins/onlyoffice-php/doceditor.php?type=desktop&action=review&folder=formularios&fileID=") }}'+key.encodeFilePath+'" class="list-group-item mt-3" target="_blank"> <span style="font-size: 150%">Revisão <b>' +key.revisao+ '</b></span>:  ' + key.nome.split('_rev')[0]; 
                a += '</a>';
                $("#reviews-list-div").append(a);
            });
        }, function(err) {
        });
    });

    $('.iframe_box').block({ 
        message: '<h3>Carregando...</h3>', 
        css: { 
            padding:'10px 0 0 0',
            color:'#fff',
            'border-radius':'20px',
            'background-color':'rgba(255, 255, 255, 0.7)'
        } 
    }); 

    setTimeout(() => {
        $('iframe').map((key, iframe) => $(iframe).attr('src', $(iframe).attr('data-src')));
        $('.iframe_box').unblock();
    }, 8000);

    // Click no botão para enviar a nova revisão do formulário
    $("#btn-send-new-review").on('click', function() {
        let valueInputFile = $("#new_review_form").val();
        if( !valueInputFile ) {
            showToast('Opa!', 'Importe o formulário antes de enviar!', 'warning');
            return;
        }
        
        let formId  = $('input[name=formulario_id]').val();
        let newCode = $('#newCodigoFormulario').val();
        var obj = {'codigo': newCode, 'formulario_id': formId};
        ajaxMethod('POST', " {{ URL::route('ajax.formularios.checkIfCodeExists') }} ", obj).then(function(result) {
            if(result.exist) {
                showToast('Opa!', 'Já existe um formulário utilizando esse código!', 'error');
                return;
            }
            
            $("#form-new-review").submit();
        }, function(err) {
            console.log(err);
            showToast('Opa!', 'Não conseguimos verificar se existe um formulário com esse código. Por favor, contate o suporte técnico!', 'warning');
        });
    });

</script>

 @if($resp)
    <script src="{{ asset('js/utils-speed.js') }}"></script>    
    <script>
        showToast("{{$resp['title']}}", "{{$resp['msg']}}", "{{$resp['status']}}");
    </script>
@endif


@endsection