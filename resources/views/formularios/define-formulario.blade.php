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
        $("#message-overlay").text('FORMULÁRIO ENCAMINHADO AO SETOR DE PROCESSOS PARA AVALIAÇÃO');
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
                        <button class="right-side-toggle waves-light btn-success btn btn-circle btn-xl pull-right m-l-10   btn-badge badge-top-right" data-count="{{ count(\App\Classes\Helpers::instance()->getNotifications( Auth::user()->id )) }}">
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
            
            <!-- Informações do Novo Documento -->
            <div class="row">
                <div class="col-12">

                    <!-- Card -->
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="pull-left"><b>TÍTULO DO FORMULÁRIO: </b>{{ explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $tituloFormulario)[0] }}  </p>
                                </div>
                                
                                <div class="col-md-6 form-material" style="margin-bottom: -2%; margin-left: -6.0%; margin-top: -0.5%;">
                                    <div class="form-group row">
                                        <label for="codigoFormulario" class="col-sm-3 text-right control-label col-form-label"><b>CÓDIGO: </b></label>
                                        <div class="col-md-9">
                                            <input name="codigoFormulario" id="codigoFormulario" type="text" class="form-control" value="{{ $codigoFormulario }}" style="max-width: 50%; float: left; margin-left: -4%;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <p class="pull-left"><b>SETOR: </b>{{ $text_setorDono }}  </p>
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

                                        {!! Form::open(['route' => 'formularios.save-attached-document', 'method' => 'POST', 'id' => 'form-upload-form', 'enctype' => 'multipart/form-data']) !!}
                                            {{ csrf_field() }}

                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title"> Upload de formulários </h4>
                                                    <label for="input-file-now">Por favor, anexe o arquivo que você deseja controlar dentro do sistema.</label>
                                                    {!! Form::file('doc_uploaded', ['class' => 'dropify', 'id' => 'input-file-now', 'required' => 'required', 'data-allowed-file-extensions'=>'doc docx xlsx xls']) !!}
                                                    
                                                    {!! Form::hidden('nivel_acesso',                $nivelAcessoDocumento) !!}
                                                    {!! Form::hidden('setor_dono_form',             $setorDono) !!}                                             
                                                    {!! Form::hidden('nome_formulario',             $tituloFormulario) !!}
                                                    {!! Form::hidden('registroControle',            $registroControle) !!}

                                                    @if( is_array($grupoDivulgacaoFormulario) && count($grupoDivulgacaoFormulario) > 0 )
                                                        @foreach($grupoDivulgacaoFormulario as $usuariosGrupoDivulgacaoFormulario)
                                                            <input type="hidden" name="grupoDivulgacaoFormulario[]" value="<?php echo $usuariosGrupoDivulgacaoFormulario ?>">
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="col-md-offset-2 col-md-3 pull-right">
                                                    {!! Form::button('Salvar Formulário', ['class' => 'btn btn-lg btn-block btn-success', 'id' => 'btn-save-document']) !!}
                                                </div>
                                                <div class="col-md-offset-2 col-md-3 pull-right">
                                                    <button type="button" class="btn waves-effect waves-light btn-block btn-lg btn-secondary" onclick="history.back()">Voltar</button>
                                                </div>
                                            </div>

                                        {!! Form::close() !!}

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

@endif


@endsection


@section('footer')

    <script>
        // Click no botão para salvar formulário
        $("#btn-save-document").click(function(){
            var valueInputFile = $("#input-file-now").val();
            if( !valueInputFile ) {
                showToast('Opa!', 'Importe um documento antes de salvar!', 'warning');
                return;
            }
            
            var codigoFormulario = $("#codigoFormulario").val();
            let obj = {'codigo': codigoFormulario};
            ajaxMethod('POST', " {{ URL::route('ajax.formularios.checkIfCodeExists') }} ", obj).then(function(result) {
                if(result.exist) {
                    showToast('Opa!', 'Já existe um formulário utilizando esse código!', 'error');
                    return;
                }
                
                $(this).prop('disable', true).attr('disabled', 'disabled');
    
                $("#form-upload-form").append("<input type='hidden' name='codigoFormulario' value='"+codigoFormulario+"' >")
                $("#form-upload-form").submit();
            }, function(err) {
                showToast('Opa!', 'Não conseguimos verificar se existe um formulário com esse código. Por favor, contate o suporte técnico!', 'warning');
                return;
            });
        });
    </script>

@endsection