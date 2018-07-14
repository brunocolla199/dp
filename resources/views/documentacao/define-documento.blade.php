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
            window.location.href = " {{ URL::route('documentacao') }} ";
        }
    </script>



@if (isset($overlay_sucesso))
    <script>
        openNav();
        $("#message-overlay").text('DOCUMENTO ENCAMINHADO AO SETOR DE QUALIDADE PARA AVALIAÇÃO');
        $("#icon-overlay").removeClass('fa-send').addClass('fa-check');
    </script>
@else

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
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('documentacao') }}">Documentação</a></li>
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
                                <div class="col-md-5">
                                    <p class="pull-left"><b>TÍTULO DO DOCUMENTO: </b>{{ $tituloDocumento }}  </p>
                                </div>
                                <div class="col-md-3">
                                    <p><b>CÓDIGO: </b>{{ $codigoDocumento }}  </p>
                                </div>
                                <div class="col-md-4">
                                    <p><b>VALIDADE DO DOCUMENTO: </b>{{ $validadeDocumento }}  </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="pull-left"><b>SETOR DO DOCUMENTO: </b>{{ $view_setorDono }}  </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><b>APROVADOR: </b>{{ $view_aprovador }}  </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="pull-left"><b>ÁREA DE INTERESSE: </b>{{ $view_grupoInteresse }}  </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><b>TIPO DE DOCUMENTO: </b>{{ $view_tipo_documento }}  </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="pull-left"><b>GRUPO DE TREINAMENTO: </b>{{ $view_areaTreinamento }}  </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><b>GRUPO DE DIVULGAÇÃO: </b>{{ $view_grupoDivulgacao }}  </p>
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

                                    
                                    {!! Form::open(['route' => 'documentacao.save-attached-document', 'method' => 'POST', 'id' => 'form-upload-document', 'enctype' => 'multipart/form-data']) !!}
                                        {{ csrf_field() }}

                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title"> Upload de documentos </h4>
                                                <label for="input-file-now">Por favor, anexe o arquivo que você deseja controlar dentro do sistema.</label>
                                                {!! Form::file('doc_uploaded', ['class' => 'dropify', 'id' => 'input-file-now']) !!}
                                                
                                                {!! Form::hidden('tipo_documento', $tipo_documento) !!}
                                                {!! Form::hidden('id_aprovador', $aprovador) !!}
                                                {!! Form::hidden('areaTreinamento', $areaTreinamento) !!}
                                                {!! Form::hidden('grupoDivulgacao', $grupoDivulgacao) !!}
                                                {!! Form::hidden('grupoInteresse', $grupoInteresse) !!}
                                                {!! Form::hidden('tipo_grupoInteresse', $tipo_grupoInteresse) !!}
                                                {!! Form::hidden('setor_dono_doc', $setorDono) !!}
                                                {!! Form::hidden('tituloDocumento', $tituloDocumento) !!}
                                                {!! Form::hidden('codigoDocumento', $codigoDocumento) !!}
                                                {!! Form::hidden('validadeDocumento', $validadeDocumento) !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="col-md-offset-6 col-md-3 pull-right">
                                                {!! Form::submit('Salvar Documento', ['class' => 'btn btn-lg btn-success', 'id' => 'btn-save-document']) !!}
                                            </div>
                                        </div>

                                    {!! Form::close() !!}

                                </div>
                            </div>
                            @else
                            <!-- <div>
                                <div class="row">
                                    <h3> Novo Documento: </h3>
                                </div>

                                <div class="row">
                                    <textarea id="ckeditor"></textarea>
                                </div>
                            </div> -->


                            <h1>Document editor</h1>

                            <!-- The toolbar will be rendered in this container. -->
                            <div id="toolbar-container"></div>

                            <!-- This container will become the editable. -->
                            <div id="editor" style="height:500px;">
                                <p>This is the initial editor content.</p>
                            </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->


        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper -->
    <!-- ============================================================== -->


@endif


@endsection


@section('footer')

    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        DecoupledEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container' );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection