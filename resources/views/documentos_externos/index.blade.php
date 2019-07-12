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
                            
                            <div id="sectorsList" class="accordion" role="tablist" aria-multiselectable="true">
                                <div id="accordionexample" class="accordion" role="tablist" aria-multiselectable="true">
                                
                                    @forelse ($areasBySector as $areaId => $areaName)

                                        <div class="card">
                                            <div class="card-header cursor-pointer-on" role="tab" id="{{ $areaId }}" data-toggle="collapse" data-parent="#accordionexample" href="#{{ 'registros-'.$areaId }}" aria-expanded="false" aria-controls="{{ 'registros-'.$areaId }}">
                                                <h3 class="mb-0">  {{ $areaName }}  </h3>
                                            </div>
                                            <div id="{{ 'registros-'.$areaId }}" class="collapse" role="tabpanel" aria-labelledby="{{ $areaId }}">
                                                <div class="card-body">
                                                    
                                                    <!-- Here we insert another nested accordion -->
                                                    @if ( !is_null($registers->get($areaId)) && $registers->get($areaId)->count() > 0 )
                                                        @foreach ($registers->get($areaId) as $register)
                                                            <div class="card">
                                                                <div class="card-header cursor-pointer-on" role="tab" id="{{ 'reg-'.$register->id }}" data-toggle="collapse" data-parent="#{{ 'registros-'.$areaId }}" href="#{{ $register->id }}" aria-expanded="true" aria-controls="{{ $register->id }}">
                                                                    <h4 class="mb-0 h4-click" data-opened="false" data-id="{{ $register->id }}" data-area-id="{{ $register->idArea }}"> 
                                                                        <i class="mdi mdi-format-list-bulleted"></i> {{ $register->listaIndice[2]->valor }}
                                                                    </h4>
                                                                </div>
                                                            
                                                                <div id="{{ $register->id }}" class="collapse" role="tabpanel" aria-labelledby="{{ 'reg-'.$register->id }}">
                                                                    <div class="card-body">
                                                                        
                                                                        <div class="row" id='docs-{{ $register->id }}'></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <h6 class="text-center">Não existe nenhum documento nesta área!</h6>              
                                                    @endif
                                                    <!-- Inner accordion ends here -->
            
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    
                                        <h5 class="text-center">Não existe nenhuma área criada para os setores que você tem acesso!</h5>
                                    @endforelse
                                </div>    
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



    <!-- This is data table -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    
    <!-- start - This is for export functionality only -->
    <script src="{{ asset('js/dataTables/dataTables-1.2.2.buttons.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/buttons-1.2.2.flash.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/jszip-2.5.0.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/pdfmake-0.1.18.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/vfs_fonts-0.1.18.js') }}"></script>
    <script src="{{ asset('js/dataTables/buttons-1.2.2.html5.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/buttons-1.2.2.print.min.js') }}"></script>
    <!-- end - This is for export functionality only -->    

    {{-- DataTable --}}
    <script>
        $(document).ready(function() {
            $('#tabela-controle-registros').DataTable({
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'excel',  text: 'Excel' },
                    { extend: 'pdf',    text: 'PDF' },
                    { extend: 'print',  text: 'Imprimir' }
                ]
            });
        });
    </script>



    <!-- jQuery Loading Plugin -->
    <link href="{{ asset('plugins/jquery-loading/jquery.loading.min.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/jquery-loading/jquery.loading.min.js') }}"></script>



    {{-- Adiciona os documentos do registro no body do card --}}
    <script>
        $(".h4-click").on('click', function() {
            let opened = $(this).data('opened');
            $(this).data('opened', !opened); 
            
            if(!opened) {
                let gedDocumentUrl = "{{ env('GED_URL') }}".replace('rest', '') + 'baixarDocumento.do?idArea=';
                let areaId         = $(this).data('area-id');
                let registerId     = $(this).data('id');
                let obj            = {'register_id': registerId};
                
                let elmDiv = $("#docs-" + registerId);
                elmDiv.empty();
                elmDiv.loading();

                ajaxMethod('POST', " {{ URL::route('documentos-externos.documentos') }} ", obj).then(function(result) {
                    let baseUrl = "{{ url('/') }}"; 

                    result.response.forEach((value, index) => {
                        elmDiv.append(`
                            <div class="col-md-3">
                                <center class="m-t-20 center-open-pdf" data-id="${value.id}" style="cursor: pointer;"> 
                                    <i class="mdi mdi-file-pdf" style="font-size: 50px"></i>
                                    <h4 class="card-title m-t-10">${value.endereco}</h4>
                                </center>
                                <a href="${baseUrl + '/documentos-externos/acessar-documento/' + value.id}" target="_blank" class="btn btn-info btn-block">Acessar</a>
                            </div>
                        `);
                    });

                    elmDiv.loading('stop');
                }, function(err) {
                    console.log(err);
                });
            }
        });
    </script>


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