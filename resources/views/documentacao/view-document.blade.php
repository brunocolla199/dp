@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-12 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Visualização de Documento</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('documentacao') }}">Documentação</a></li>
                        <li class="breadcrumb-item active">Visualização de Documento</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-xl pull-right m-l-10"><i class="ti-comment-alt text-white"></i></button>
                    </div>
                </div>
            </div>
            
            
            <!-- Start Page Content -->


            {!! Form::open(['route' => 'documentacao.save-edited-document', 'method' => 'POST', 'id' => 'form-edit-document', 'enctype' => 'multipart/form-data']) !!}
                {{ csrf_field() }}

                 {!! Form::hidden('document_id', $document_id) !!}

                <div class="row">
                    <div class="col-md-12 card">
                        <div class=" card-body">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('tituloDocumento', 'TÍTULO DO DOCUMENTO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('tituloDocumento', $nome, ['class' => 'form-control', 'readonly']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('codigoDocumento', 'CÓDIGO DO DOCUMENTO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('codigoDocumento', $codigo, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div> 
                                    <!-- <div class="col-md-4">
                                        <div class="control-label font-bold text-center">
                                            Download Documento<br>
                                            <div class="text-center">
                                                <a href="{{url('/download/'.$docPath)}}" target="_blank"><br>
                                                    <i class="fa fa-download fa-2x"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>  -->
                                </div>
                            </div>

                            <!-- Editor -->

                            <div class="container" >
                                <textarea id="speed-editor">
                                    
                                </textarea>
                            </div>

                            <!-- End Editor -->
                                
                            
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <br>
                                    <input type="button" id="btn-save-document" class="btn btn-lg btn-success" value="Salvar Alterações">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                
                <!-- End Page Content -->

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('footer')

<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script src="{{ asset('plugins/ckeditor-document-editor/initEditor.js') }}"></script>

<script>

    initEditor('{!! $docData !!}', '{{ asset("plugins/ckeditor-document-editor/css/speed-editor.css") }}');

    $("#btn-save-document").click(function(){
        var docData = CKEDITOR.instances['speed-editor'].getData();
        $("#form-edit-document").append("<input type='hidden' name='docData' value='"+docData+"' >")
        $("#form-edit-document").submit();
    });
</script>

 @if($resp)
    <script src="{{ asset('js/utils-speed.js') }}"></script>    
    <script>
        showToast("{{$resp['title']}}", "{{$resp['msg']}}", "{{$resp['status']}}");
    </script>
@endif


@endsection