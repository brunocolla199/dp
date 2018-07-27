<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/dpworld.ico') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/style-material-pro-main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom-speed.css') }}" rel="stylesheet">

    <!-- You can change the theme colors from here -->
    <link href="{{ asset('css/colors/blue.css') }}" id="theme" rel="stylesheet">



    <!-- Others -->
    <!-- Toast CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/toast-master/css/jquery.toast.css') }}">

    <!--This page css - Morris CSS -->
    <link href="{{ asset('plugins/c3-master/c3.min.css') }}" rel="stylesheet">
    
    <!-- Vector CSS -->
    <link href="{{ asset('plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    
    <!-- SweetAlert CSS -->
    <link href="{{ asset('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
    
    <!-- MultiSelect CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/multiselect/css/multi-select.css') }}">
    
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">

    <!-- Styles | Este é o estilo padrão/principal criado pelo próprio Laravel -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->


    <!-- Moments with locales [Tive que deixar aqui para reconhecer o script antes de carregar o conteúdo da página] -->
    <script src="{{ asset('plugins/moment/min/moment-with-locales.min.js') }}"></script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div> -->

    <!-- Overlay Screen -->
    <div id="div-overlay-define-documento" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="#" id="message-overlay">ENVIANDO SEU ARQUIVO...</a>
            <a href="#"><i class="fa fa-send" id="icon-overlay"></i></a>
        </div>
    </div>




    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">




        @if (!Auth::guest())
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{'home'}}">
                            <!-- Logo icon -->
                            <b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <!-- <img src="{{ asset('images/logo-icon.png') }}" alt="homepage" class="dark-logo" /> -->
                                
                                <!-- Light Logo icon -->
                                <!-- <img src="{{ asset('images/logo-light-icon.png') }}" alt="homepage" class="light-logo" /> -->
                                <img src="{{ asset('images/dp-logo-icon.png') }}" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span>
                            <!-- dark Logo text -->
                            <!-- <img src="{{ asset('images/logo-text.png') }}" alt="homepage" class="dark-logo" /> -->
                            
                            <!-- Light Logo text -->    
                            <!-- <img src="{{ asset('images/logo-light-text.png') }}" class="light-logo" alt="homepage" /></span> </a> -->
                            <!-- <img src="{{ asset('images/dp-logo-text.png') }}" alt="homepage" class="light-logo" /></span> </a> -->
                            <img src="{{ asset('images/dp-logo-text-white.png') }}" alt="homepage" class="light-logo" /></span> </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->

                    @if (!Auth::guest())
                        <div class="navbar-collapse">
                            <!-- ============================================================== -->
                            <!-- toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav mr-auto mt-md-0">
                                <!-- This is  -->
                                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>                                
                            </ul>
                            <ul class="navbar-nav my-lg-0">                                
                                <!-- ============================================================== -->
                                <!-- Language -->
                                <!-- ============================================================== -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-br"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right scale-up"> 
                                        <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-br"></i> Português (Brasil)</a> 
                                        <!-- <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-us"></i> Inglês</a>  -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- <div class="navbar-collapse">
                            <ul class="navbar-nav my-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                                </li>
                            </ul>
                        </div> -->
                    @endif

                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
        @endif





        @if (!Auth::guest())
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- User profile -->
                    
                    <div class="user-profile" style="background: url({{ asset('images/background/work.jpg') }}) no-repeat;">
                        <!-- User profile image -->
                        <div class="profile-img" style="height: 130px;"> </div>
                        <!-- User profile text-->
                        <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Olá, <b>{{ explode(' ', Auth::user()->name)[0] }}!</b></a>
                            <div class="dropdown-menu animated flipInY">
                                <!-- <a href="#" class="dropdown-item"><i class="ti-user"></i> Meu Perfil</a>
                                <a href="#" class="dropdown-item"><i class="ti-settings"></i> Configurações</a> -->
                                    <!-- <div class="dropdown-divider"></div>  -->
                                <a href="{{ url('/logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Sair</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User profile text-->
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="{{ (\Request::is('bpmn/*')) ? 'active' : '' }}">
                                <a class="waves-effect waves-dark {{ (\Request::is('bpmn/*')) ? 'active' : '' }}" href="{{ url('/bpmn') }}" aria-expanded="false"><i class="mdi mdi-file-tree"></i><span class="hide-menu">BPMN 2.0 </span></a>    
                            </li>
                            <li class="{{ (\Request::is('documentacao/*')) ? 'active' : '' }}">
                                <a class="waves-effect waves-dark {{ (\Request::is('documentacao/*')) ? 'active' : '' }}" href="{{ url('/documentacao') }}" aria-expanded="false"><i class="mdi mdi-library-books"></i><span class="hide-menu">Documentação </span></a>    
                            </li>
                            <li class="{{ (\Request::is('formularios/*')) ? 'active' : '' }}">
                                <a class="waves-effect waves-dark {{ (\Request::is('formularios/*')) ? 'active' : '' }}" href="{{ url('/formularios') }}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Formulários </span></a>    
                            </li>
                            <li class="{{ (\Request::is('configuracoes/*')) ? 'active' : '' }}">
                                <a class="waves-effect waves-dark {{ (\Request::is('configuracoes/*')) ? 'active' : '' }}" href="{{ url('/configuracoes') }}" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Configurações </span></a>    
                            </li>
                            <li class="{{ (\Request::is('sobre/*')) ? 'active' : '' }}">
                                <a class="waves-effect waves-dark {{ (\Request::is('sobre/*')) ? 'active' : '' }}" href="{{ url('/sobre') }}" aria-expanded="false"><i class="mdi mdi-help"></i><span class="hide-menu">Sobre </span></a>    
                            </li>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
                <!-- Bottom points-->
                <div class="sidebar-footer">
                    <!-- item-->
                    <a href="http://speedsoftware.com.br/" target="_blank" class="link" data-toggle="tooltip" title="Speed Software"><img src="{{ asset('images/speed-logo-gray.png') }}" class="img-fluid" alt="Speed Softwares - Logo"></a>
                    <!-- item-->
                    <a href="{{ url('/') }}" class="link" data-toggle="tooltip" title="Dashboard"><i class="mdi mdi-home"></i></a>
                    <!-- item-->
                    <a href="{{ url('/logout') }}" class="link" data-toggle="tooltip" title="Sair"><i class="mdi mdi-power"></i></a>
                </div>
                <!-- End Bottom points-->
            </aside>
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
        @endif






        @yield('content')





        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title" style="font-size: 120%"> NOTIFICAÇÕES <span><i class="ti-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body">
                    <div class="row mb-4">

                        <div class="col-md-12">
                            <div class="ribbon-wrapper card">
                                <div class="ribbon ribbon-bookmark  ribbon-success"> IT - QUA - 001 </div>
                                <p class="ribbon-content">O documento código <a href="javascript:void(0)"><b> IT-QUA-001 </b></a> vence em 20/04/2018 </p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="ribbon-wrapper card">
                                <div class="ribbon ribbon-bookmark  ribbon-primary">DG - 001</div>
                                <p class="ribbon-content">O documento código <a href="javascript:void(0)"><b> DG-001 </b></a> vence em 20/04/2018</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="ribbon-wrapper card">
                                <div class="ribbon ribbon-bookmark  ribbon-info">PG - 001</div>
                                <p class="ribbon-content">O documento código <a href="javascript:void(0)"><b> PG-001 </b></a> foi finalizado</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="ribbon-wrapper card">
                                <div class="ribbon ribbon-bookmark  ribbon-warning">FR - OPE - 001</div>
                                <p class="ribbon-content">O formulário código <a href="javascript:void(0)"><b> FR-OPE-001 </b></a> foi criado</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->





        <!-- modal para selecionar novo setor ao usuário [utilizado nas vinculações] -->
        <div id="new-sector-to-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Definindo novo setor para o usuário</h4>
                            <button type="button" class="close cancel-change-sector-user" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 alert alert-warning">
                                <p class="text-justify">
                                    <b>Você está prestes a desvincular o usuário selecionado deste setor.</b> <small>Portanto, precisamos que você defina um novo setor para este usuário:</small>
                                </p>
                            </div>
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

                            <div class="form-group">
                                {!! Form::label('novo_setor_do_usuario', 'NOVO SETOR DO USUÁRIO:') !!}
                                {!! Form::select('novo_setor_do_usuario', ['ovo', 'ovo2'], '', ['class' => 'form-control', 'id' => 'novo_setor_do_usuario', 'style' => 'height: auto']) !!}
                            </div>
                        <div class="modal-footer">
                            <span class="text-left"> Tem certeza que deseja alterar? </span>
                            <button type="button" class="btn btn-default waves-effect cancel-change-sector-user" data-dismiss="modal">Cancelar</button>
                            <button type="button" id="changeSectorUser" class="btn btn-success waves-effect waves-light">Alterar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal para selecionar novo setor ao usuário -->

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->











    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    
    <!--Wave Effects -->
    <script src="{{ asset('js/waves.js') }}"></script>
    
    <!--Menu sidebar -->
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    
    <!--stickey kit -->
    <script src="{{ asset('plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    
    <!--Custom JavaScript -->
    <script src="{{ asset('js/custom.min.js') }}"></script>
    

    <!-- Bootstrap Switch -->
    <link href="{{ asset('plugins/bootstrap-switch/bootstrap-switch.min.css') }}"  rel="stylesheet">
    <script src="{{ asset('plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
    <script type="text/javascript">
        $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
        var radioswitch = function() {
            var bt = function() {
                $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioState")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
                }), $(".radio-switch").on("switch-change", function() {
                    $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
                })
            };
            return {
                init: function() {
                    bt()
                }
            }
        }();
        $(document).ready(function() {
            radioswitch.init()
        });
    </script>

    <!--c3 JavaScript -->
    <script src="{{ asset('plugins/d3/d3.min.js') }}"></script>
    <script src="{{ asset('plugins/c3-master/c3.min.js') }}"></script>
    
    <!-- Vector map JavaScript -->
    <script src="{{ asset('plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('plugins/vectormap/jquery-jvectormap-us-aea-en.js') }}"></script>

    <!-- Style switcher -->
    <script src="{{ asset('plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
    
    <!-- SweetAlert JS -->
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>    
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>    

    <!-- Toast JS -->
    <script src="{{ asset('plugins/toast-master/js/jquery.toast.js') }}"></script>    
    <script src="{{ asset('js/toastr.js') }}"></script>    
    
    <!-- Speed Custom JS -->
    <script src="{{ asset('js/utils-speed.js') }}"></script>     

    <!-- jQuery file upload -->
    <script src="{{ asset('plugins/dropify/dist/js/dropify.min.js') }}"></script>   
    <script>
        $(document).ready(function() {
            // Basic
            $('.dropify').dropify({
                messages: {
                    default: 'Arraste um arquivo para cá ou clique',
                    replace: 'Arraste um arquivo para cá ou clique para substituir',
                    remove: 'Remover',
                    error: 'Erro ao processar arquivo, contate o suporte técnico (suporte@speedsoftware.com.br)'
                },
                error:{
                    fileExtension:'O formato do arquivo não é suportado (pdf doc docx xlsx xls apenas).'
                } 
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Você realmente deseja deletar \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('Arquivo deletado');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>

    <!-- MultiSelect -->
    <script src="{{ asset('plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            /*
            * 
            * MultiSelect de DIRETORIA / GERÊNCIA
            * 
            */
            $('#optgroup').multiSelect({
                selectableOptgroup: true,

                afterDeselect: function(values){
                    window.sessionStorage.setItem("id_usuario_atual_desvinculacao", values[0]);

                    var id = $("#optgroup").data('setor');
                    var obj = {'id_setor': id};
                    ajaxMethod('POST', " {{ URL::route('ajax.setores.retornaSetoresExcetoUm') }} ", obj).then(function(result) {
                        $("#novo_setor_do_usuario option").remove();
                        
                        Object.keys(result.response).forEach(function(key) {
                            $('#novo_setor_do_usuario').append($('<option>', { 
                                value: key,
                                text : result.response[key]
                            }));
                        });
                    }, function(err) {
                        console.log(err);
                    });

                    $("#new-sector-to-user").modal({
                        backdrop: 'static',
                        'keyboard': false
                    });
                }

            });

            // 'Click' em "Alterar" no modal para definir um novo setor para o usuário
            $("#changeSectorUser").click(function() {
                var obj = {'user': window.sessionStorage.getItem('id_usuario_atual_desvinculacao'), 'new_sector': $("#novo_setor_do_usuario").val()};

                console.log(obj);
                ajaxMethod('POST', " {{ URL::route('ajax.usuarios.trocarSetor') }} ", obj).then(function(result) {
                    window.sessionStorage.clear();
                    location.reload();
                }, function(err) {
                    console.log(err);
                });
            });
        
            // Fechou modal sem selecionar um novo setor
            $('.cancel-change-sector-user').click(function (e) {
                window.sessionStorage.clear();
                location.reload();
            });



            /*
            * 
            * MultiSelect de GRUPOS DE TREINAMENTO
            *
            */
            $('#optgroup-grupoT').multiSelect({
                selectableOptgroup: true,

                afterDeselect: function(values){
                    var id = $("#optgroup-grupoT").data('setor');
                    var obj = {'id_grupo': id, 'id_user': values[0], 'tipo_grupo': 'treinamento'};

                    ajaxMethod('POST', " {{ URL::route('ajax.usuarios.removerDoGrupo') }} ", obj).then(function(result) {
                    }, function(err) {
                    });
                }
            });



            /*
            * 
            * MultiSelect de GRUPOS DE DIVULGAÇÃO
            *
            */
            $('#optgroup-grupoD').multiSelect({
                selectableOptgroup: true,

                afterDeselect: function(values){
                    var id = $("#optgroup-grupoD").data('setor');
                    var obj = {'id_grupo': id, 'id_user': values[0], 'tipo_grupo': 'divulgacao'};

                    ajaxMethod('POST', " {{ URL::route('ajax.usuarios.removerDoGrupo') }} ", obj).then(function(result) {
                    }, function(err) {
                    });
                }
            });



            /*
            * 
            * MultiSelect de NOVA ÁREA DE INTERESSE
            *
            */
            $('#optgroup-newAreaDeInteresse').multiSelect({selectableOptgroup: true});

        });
    </script>

    <!-- Select2 JS -->
    <script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(".select2").select2();
    </script>

    <!-- Scripts | Este é o script padrão/principal criado pelo próprio Laravel -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->

     @yield('footer')

</body>
</html>
