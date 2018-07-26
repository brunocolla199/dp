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
            window.location.href = " {{ URL::route('formularios') }} ";
        }
    </script>

@if (isset($overlay_sucesso))
    <script>
        openNav();
        $("#message-overlay").text('FORMULÁRIO ENCAMINHADO AO SETOR DE QUALIDADE PARA AVALIAÇÃO');
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
                    <h3 class="text-themecolor m-b-0 m-t-0">Definição de Formulário</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('formularios') }}">Formulários</a></li>
                        <li class="breadcrumb-item active">Definição de Formulário</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-xl pull-right m-l-10"><i class="ti-comment-alt text-white"></i></button>
                    </div>
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
                                <div class="col-md-6">
                                    <p class="pull-left"><b>TÍTULO DO FORMULÁRIO: </b>{{ $tituloFormulario }}  </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><b>CÓDIGO: </b>{{ $codigoFormulario }}  </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><b>SETOR: </b>{{ $text_setorDono }}  </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><b>GRUPO DE DIVULGAÇÃO: </b>{{ $text_grupoDivulgacao }}  </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="pull-left"><b>NÍVEL DE ACESSO: </b>{{ $nivelAcessoDocumento }}  </p>
                                </div>

                            </div>
                            
                           
                          
                        </div>
                        <div class="card-footer text-muted">
                            Informações do Novo Formulário
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

                                

                                </div>
                            </div>
                            @else

                            <h3>Novo Formulário:</h3>
                            <!-- Formbuilder -->
                            <div class="container" >
                                <section id="main_content" class="inner">
                                    <form class="build-form clearfix"></form>
                                </section>
                            </div>
                            <!-- End Formbuilder -->
                                    
                            {!! Form::open(['route' => 'formularios.save-new-form', 'method' => 'POST', 'id' => 'form-upload-new-form', 'enctype' => 'multipart/form-data']) !!}
                                {{ csrf_field() }}
                                

                                {!! Form::hidden('codigoFormulario',        $codigoFormulario) !!}
                                {!! Form::hidden('nivel_acesso',            $nivelAcessoDocumento) !!}
                                {!! Form::hidden('grupoDivulgacao',         $grupoDivulgacao) !!}
                                {!! Form::hidden('setor_dono_form',         $setorDono) !!}                                             
                                {!! Form::hidden('tituloFormulario',        $tituloFormulario) !!}
                                
                            {!! Form::close() !!}
      

                            <div class="col-lg-12 col-md-12">
                                <br>
                                <div class="col-md-offset-2 col-md-3 pull-right">
                                    <input type="button" id="btn-save-new-form" class="btn btn-lg btn-success" value="Salvar Formulário">
                                </div>
                                <div class=" col-md-3 pull-right">
                                    <button id="renderForm" data-toggle="modal" data-target="#preview-form-modal" class="btn waves-effect waves-light btn-block btn-lg btn-primary">Pré-visualizar </button>
                                </div>
                                <div class="col-md-offset-2 col-md-3 pull-right">
                                    <button type="button" class="btn waves-effect waves-light btn-block btn-lg btn-secondary" onclick="history.back()">Voltar</button>
                                </div>
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



@endif


@endsection


@section('footer')

        <script src="{{ asset('plugins/formeo/formeo.min.js') }}"></script>
        <script src="{{ asset('plugins/formeo/initFormeo.js') }}"></script>

        <script>
            initFormeo('', '{{ url("/") }}');
            $("#btn-save-new-form").click(function(){
                var formData = JSON.stringify(window.sessionStorage.getItem('formData'));
                
                $("#form-upload-new-form").append("<input type='hidden' name='formData' value='"+formData+"' >")
                $("#form-upload-new-form").submit();
            });
        </script>




@endsection