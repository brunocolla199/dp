@extends('layouts.app')

@section('content')
    
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <div class="container-fluid">
            

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Documentos Externos</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Documentos Externos</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-light btn-success btn btn-circle btn-xl pull-right m-l-10  btn-badge badge-top-right" data-count="{{ count(\App\Classes\Helpers::instance()->getNotifications( Auth::user()->id )) }}">
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

                            @if(Session::has('message'))
                                <div class="alert alert-{{str_before(Session::get('style'), '|')}}"> <i class="mdi mdi-{{str_after(Session::get('style'), '|')}}"></i> {{ Session::get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                            @elseif(Session::has('removed-doc-success'))
                                <div class="alert alert-success"> <i class="mdi mdi-check-circle"></i> {{ Session::get('removed-doc-success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>

                                @php
                                    Session::forget('removed-doc-success');
                                @endphp
                            @endif

                            <div class="row">
                                <div class="col-md-8">
                                    <form action="{{ route('documentos-externos.store') }}" class="dropzone" id="my-dropzone" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        
                                        <div class="fallback">
                                            <input name="file" type="file" multiple required />
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    @if ($nonCreatedArea)
                                        <h3 class="text-center mt-5">Não existe área criada para o seu setor.</h3> 
                                        <h5>Por favor, solicite ao suporte técnico para que ela seja criada!</h5>
                                    @else
                                        <div class="form-group">
                                            <div class="col-md-10 control-label font-bold">
                                                {!! Form::label('sector', 'Setor:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('sector', $areasBySector, null, ['class' => 'form-control  custom-select', 'id' => 'id_area_sector', 'required' => 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 mt-1">
                                                <input type="checkbox" id="i_approve" name="i_approve" class="filled-in" />
                                                <label for="i_approve">Eu li e defino esse(s) documento(s) como <span class="font-weight-bold">validado(s)</span>.</label>

                                                <button class="btn btn-block btn-success mt-4" id="btn-upload-docs">Salvar</button>
                                                <a href="{{ route('documentos-externos') }}" class="btn btn-block btn-secondary">Limpar</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <hr style="border: 1px solid gray;">

                            <div class="table-responsive m-t-40">
                                <table id="tabela-documentos-externos" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-nowrap noExport">Ações</th>
                                            <th class="text-center text-nowrap">Setor</th>
                                            <th class="text-center">Título do Documento</th>
                                            <th class="text-center">Data de Criação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registers as $register)
                                            <tr>
                                                <td class="text-center text-nowrap">
                                                    <a href="#" ><i class="fa fa-file-text-o text-primary center-open-pdf mr-3" data-id="{{$register['file']->id}}" data-toggle="tooltip" data-original-title="Visualizar Arquivo"></i></a>
                                                    <a href="{{ url('/documentos-externos/acessar-documento/' . $register['file']->id) }}" class="mr-3" ><i class="fa fa-pencil text-success" data-toggle="tooltip" data-original-title="Editar Informações"></i></a>
                                                </td>
                                                <td class="text-center text-nowrap">{{$register['areaName']}}</td>
                                                <td class="text-center text-nowrap">{{$register['file']->endereco}}</td>
                                                <td class="text-center text-nowrap">{{$register['file']->listaIndice[2]->valor}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
            

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper -->
    <!-- ============================================================== -->

@endsection



@section('footer')
    
    @include('componentes._script_datatables', ['tableId' => 'tabela-documentos-externos'])


    {{-- Dropzone Plugin JavaScript --}}
    <link href="{{ asset('plugins/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('plugins/dropzone-master/dist/dropzone.js') }}"></script>
    <script>
        // https://www.dropzonejs.com/#configuration
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone("#my-dropzone", {
            // paramName: "docs-externos", // The name that will be used to transfer the file
            maxFilesize: 10, // MB
            maxFiles: 15,
            parallelUploads: 15,
            uploadMultiple: true,
            acceptedFiles: 'application/pdf',
            timeout: 10000,
            autoProcessQueue: false,
            dictDefaultMessage: 'Adicione ou arraste os arquivos para cá',
            dictInvalidFileType: 'Somente arquivos .pdf são permitidos',
            dictMaxFilesExceeded: 'Você só pode subir 15 documentos por vez.',
            init: function() {
                this.on("sending", function(file, xhr, formData) {
                    formData.append("id_area_sector", $("#id_area_sector").val());
                    formData.append("sector_name", $("#id_area_sector option:selected").text());
                    formData.append("i_approve", document.getElementById("i_approve").checked);
                });

                this.on("success", function(file, response) {
                    if( 'success' in response ) {
                        swalWithReload("Sucesso!", response.success, "success");
                    } else {
                        swalWithReload("Ops!", response.error, "error");
                    }
                });
            }
        });

        $("#btn-upload-docs").on('click', function() {
            myDropzone.processQueue();
        });
    </script>


    <!-- jQuery Loading Plugin -->
    <link href="{{ asset('plugins/jquery-loading/jquery.loading.min.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/jquery-loading/jquery.loading.min.js') }}"></script>

    <script>
        $(document).on('click', '.center-open-pdf', function(event) {
            let elm = $(this);
            elm.loading();

            let documentId = $(this).data('id');
            let obj = {'document_id': documentId};

            ajaxMethod('POST', " {{ URL::route('documentos-externos.bytes') }} ", obj).then(function(result) {
                let base64EncodedPDF = result.response;
                let dataURI          = "data:application/pdf;base64," +base64EncodedPDF;
                
                openPdf(dataURI, elm);
            }, function(err) {
                console.log(err);
            });
        });


        function openPdf(dataURI, elm) {
            elm.loading('stop');
            var w = window.open('about:blank');

            setTimeout(function(){ //FireFox seems to require a setTimeout for this to work.
                let iframe = w.document.createElement('iframe');
                iframe.setAttribute('frameborder', "0");
                iframe.setAttribute('style', "border:0; top:0px; left:0px; bottom:0px; right:0px;");
                iframe.setAttribute('height', "100%");
                iframe.setAttribute('width', "100%");

                w.document.body.appendChild(iframe)
                    .src = dataURI;
            }, 10);
        }
    </script>

@endsection