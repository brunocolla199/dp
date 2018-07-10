@extends('layouts.app')

@section('content')
    <!-- O que fazer nestas situações? -->
    
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}">


    <script>
        function openNav() {
            document.getElementById("div-overlay-define-documento").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("div-overlay-define-documento").style.width = "0%";
        }
    </script>



    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper" >
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Definição de Documento</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Documentação</a></li>
                        <li class="breadcrumb-item active">Definição de Documento</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            
            <!-- Informações do Novo Documento -->
            <div class="row">
                <div class="col-12">

                    <!-- Card -->
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="pull-left"><b>TÍTULO DO DOCUMENTO: </b>{{ $tituloDocumento }}  </p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>APROVADOR: </b>{{ $aprovador }}  </p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>VALIDADE DO DOCUMENTO: </b>{{ $validadeDocumento }}  </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="pull-left"><b>ÁREA DE INTERESSE: </b>{{ $grupoInteresse }}  </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><b>TIPO DE DOCUMENTO: </b>{{ $tipo_documento }}  </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="pull-left"><b>GRUPO DE TREINAMENTO: </b>{{ $areaTreinamento }}  </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><b>GRUPO DE DIVULGAÇÃO: </b>{{ $grupoDivulgacao }}  </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            Informações do Novo Documento
                        </div>
                    </div>
                    <!-- Card -->
                    
                </div>
            </div>
            

            <!-- Ação Principal da Página -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if($acao == "import")
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    
                                    {!! Form::open(['route' => 'documentacao.validate-data', 'id' => 'form-upload-document', 'enctype' => 'multipart/form-data']) !!}

                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"> Upload de documentos </h4>
                                                <label for="input-file-now">Por favor, anexe o arquivo que você deseja controlar dentro do sistema.</label>
                                                <input type="file" id="input-file-now" class="dropify" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="col-md-offset-6 col-md-3 pull-right">
                                                {!! Form::button('Salvar Documento', ['class' => 'btn btn-lg btn-success', 'onclick' => 'openNav()', 'id' => 'btn-save-document']) !!}
                                            </div>
                                        </div>

                                    {!! Form::close() !!}

                                </div>
                            </div>
                            @else
                            <div class="row">
                                <h3>CKEditor aqui!!</h3>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->


            <script>
                $(document).ready(function(){

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $("#btn-save-document").click(function(){
                        // var obj = {'file' : $("#input-file-now").val() };
                        
                        var formData = new FormData( $("#form-upload-document") );
                        var obj = {'data' : formData };

                        $.ajax({
				    		type: 'POST',
				    		url: " {{ URL::route('inserirDocumento') }} ",
                            dataType: 'JSON',
                            data: obj,
				    		success: function (data) {
                                console.log(data.response);
                                $("#message-overlay").text('DOCUMENTO ENCAMINHADO AO SETOR DE QUALIDADE PARA AVALIAÇÃO');
                                $("#icon-overlay").removeClass('fa-send').addClass('fa-check');
				            }, error: function (err) {
				            	console.log(err);
                            }
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

@endsection