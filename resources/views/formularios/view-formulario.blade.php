@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-12 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Visualização de Formulário</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('formularios') }}">Formulários</a></li>
                        <li class="breadcrumb-item active">Visualização de Formulário</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-xl pull-right m-l-10"><i class="ti-comment-alt text-white"></i></button>
                    </div>
                </div>
            </div>
            
            
            <!-- Start Page Content -->
            @if($acao == "edit")

            {!! Form::open(['route' => 'formularios.save-edited-form', 'method' => 'POST', 'id' => 'form-edit-form', 'enctype' => 'multipart/form-data']) !!}
                {{ csrf_field() }}

                {!! Form::hidden('formulario_id', $formulario_id) !!}

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class=" card-body">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-6 control-label font-bold">
                                                    {!! Form::label('tituloFormulario', 'TÍTULO DO FORMULÁRIO:') !!}
                                                </div>
                                                <div class="col-md-12">
                                                    {!! Form::text('tituloFormulario', $nome, ['class' => 'form-control', 'readonly']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-6 control-label font-bold">
                                                    {!! Form::label('codigoFormulario', 'CÓDIGO DO FORMULÁRIO:') !!}
                                                </div>
                                                <div class="col-md-12">
                                                    {!! Form::text('codigoFormulario', $codigo, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>

                                
                                <!-- Formbuilder -->
                                <div class="container" >
                                    <section id="main_content" class="inner">
                                        <div class="build-form clearfix"></div>
                                    </section>
                                </div>
                                <!-- End Formbuilder -->

                                <div class="col-lg-12 col-md-12">
                                    <br>
                                    <div class="col-md-offset-2 col-md-3 pull-right">
                                        <input type="button" id="btn-save-form" class="btn btn-lg btn-success" value="Salvar Alterações">
                                    </div>
                                    
                                    <div class=" col-md-3 pull-right">
                                        <button id="renderForm" data-toggle="modal" type="button" data-target="#preview-form-modal" class="btn waves-effect waves-light btn-block btn-lg btn-primary">Pré-visualizar </button>
                                    </div>

                                    <div class="col-md-offset-2 col-md-3 pull-right">
                                        <button type="button" class="btn waves-effect waves-light btn-block btn-lg btn-secondary" onclick="history.back()">Voltar</button>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>


                
                <!-- End Page Content -->

            {!! Form::close() !!}


            @else

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class=" card-body">

                            <!-- Div com os botões de aprovar ou rejeitar -->
                            @if( $etapa_form == Constants::$ETAPA_WORKFLOW_ELABORADOR_NUM && $elaborador_id == Auth::user()->id) 
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">    
                                                {{ Form::open(['route' => 'formularios.resend-form', 'method' => 'POST']) }}
                                                    {{ Form::hidden('formulario_id', $formulario_id) }}
                                                    {{ Form::hidden('etapa_form', $etapa_form) }}
                                                    {!! Form::button('REENVIAR <i class="fa fa-send"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  !!}
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif( $etapa_form == Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM && !$finalizado)
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
                                                    {!! Form::button('APROVAR <i class="fa fa-check"></i>', ['type' => 'submit', 'class' => 'btn btn-lg btn-success'] )  !!}
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-12">
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('tituloFormulario', 'TÍTULO DO FORMULÁRIO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('tituloFormulario', $nome, ['class' => 'form-control', 'readonly']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('codigoFormulario', 'CÓDIGO DO FORMULÁRIO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('codigoFormulario', $codigo, ['class' => 'form-control', 'readonly']) !!}
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="control-label font-bold text-center timeline-doc-title">
                                                Timeline do Formulário
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">

                                    @if(in_array($extensao, ['pdf']))
                                        <iframe src="https://docs.google.com/viewer?url={{$filePath}}&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
                                    @else
                                        <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{$filePath}}' width='100%' height='500px' frameborder='0'></iframe>
                                    @endif
                                </div>
                                    
                                <div class="col-md-4" style="font-size:14px">
                                    <div class="form-group">
                                        
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
                                                        <h4 class="timeline-title"></h4>
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


            @endif


            


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
                                    {!! Form::label('justificativaReprovacaoDoc', 'JUSTIFICATIVA:') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Form::textarea('justificativaReprovacaoDoc', null, ['class' => 'form-control', 'required' => 'required']) !!}
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

@endsection

@section('footer')

<script src="{{ asset('plugins/formeo/formeo.min.js') }}"></script>
<script src="{{ asset('plugins/formeo/initFormeo.js') }}"></script>

<script>
    initFormeo('{!! $formData  !!}', '{{ url("/") }}');
    $("#btn-save-form").click(function(){
        var formData = JSON.stringify(window.sessionStorage.getItem('formData'));
        $("#form-edit-form").append("<input type='hidden' name='formData' value='"+formData+"' >")
        $("#form-edit-form").submit();
    });
</script>

 @if($resp)
    <script src="{{ asset('js/utils-speed.js') }}"></script>    
    <script>
        showToast("{{$resp['title']}}", "{{$resp['msg']}}", "{{$resp['status']}}");
    </script>
@endif


@endsection