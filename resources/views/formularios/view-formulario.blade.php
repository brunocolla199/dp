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


            {!! Form::open(['route' => 'formularios.save-edited-form', 'method' => 'POST', 'id' => 'form-edit-form', 'enctype' => 'multipart/form-data']) !!}
                {{ csrf_field() }}

                 {!! Form::hidden('document_id', $document_id) !!}

                <div class="row">
                    <div class="col-md-12 card">
                        <div class=" card-body">

                             <!-- Formbuilder -->
                           <div class="container" >
                                <section id="main_content" class="inner">
                                    <form class="build-form clearfix"></form>
                                </section>
                            </div>
                            <!-- End Formbuilder -->

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('tituloDocumento', 'TÍTULO DO FORMULÁRIO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('tituloDocumento', $nome, ['class' => 'form-control', 'readonly']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('codigoDocumento', 'CÓDIGO DO FORMULÁRIO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('codigoDocumento', $codigo, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div> 
                                   
                                    
                                </div>
                            </div>

                          
                                
                            
                    

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


                
                <!-- End Page Content -->

            {!! Form::close() !!}

        </div>
    </div>



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
    initFormeo('', '{{ url("/") }}');
    $("#btn-save-form").click(function(){
        var formData = JSON.stringify(window.sessionStorage.getItem('formData'));
        console.log(formData);
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