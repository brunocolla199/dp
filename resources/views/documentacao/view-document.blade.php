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
                                    <div class="col-md-4">
                                        <div class="control-label font-bold text-center">
                                            Pré-visualização do Documento<br>
                                            <div class="text-center">
                                                <a href="{{url('documentacao/make-pdf/'.$document_id)}}"  target="_blank"><br>
                                                <!-- <a href="#" data-toggle="modal" data-target="#preview-form-modal"><br> -->
                                                    <i class="fa fa-download fa-2x"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div> 
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


 <!-- modal para prévisualizar documento -->
 <div id="preview-form-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" style="max-width:825px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pré-Visualização de Documento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                
                    @if($tipo_doc == 'IT')

                        <div class="speed-header">
                            <img src="/doc_templates/IT.png">
                            <p> </p>
                            <table style="position:absolute; top:50px; right:35px; width:450px; text-align:right;" >
                                <tbody>
                                    <tr>
                                        <td colspan="3" align="right" ><span class="text-small" style="color:#ffffff"><strong>INSTRUÇÃO DE TRABALHO</strong></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="right" >  <span class="text-small" style="color:#ffffff">{{$nome}}</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-small" style="color:#ffffff"><strong>CÓDIGO: {{$codigo}} </strong></span></td>
                                        <td><span class="text-small" style="color:#ffffff"><strong>Revisão: 1</strong></span></td>
                                        <td><span class="text-small" style="color:#ffffff"><strong>Data: {{ date("d/m/Y", strtotime( $doc_date)) }}</strong></span></td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>

                        {!! $docData !!}

                    @elseif($tipo_doc == 'DG')
                    
                    @elseif($tipo_doc == 'PG')

                    @endif
            
            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal para prévisualizar documento -->


@endsection

@section('footer')

<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script src="{{ asset('plugins/ckeditor-document-editor/ckeditorConfig.js') }}"></script>
<script src="{{ asset('plugins/ckeditor-document-editor/initEditor.js') }}"></script>
<script src="{{ asset('plugins/ckeditor-document-editor/translate/pt-br.js') }}"></script>

<script>

    initEditor('{!! $docData !!}', '{{ asset("plugins/ckeditor-document-editor/css/speed-editor.css") }}', '{!! url("/") !!}');

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