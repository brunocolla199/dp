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
                        <a class="navbar-brand" href="index.html">
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
                            <img src="{{ asset('images/dp-logo-text.png') }}" alt="homepage" class="light-logo" /></span> </a>
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
                                    <div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-br"></i> Português (Brasil)</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-us"></i> Inglês</a> </div>
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
                    <div class="user-profile" style="background: url({{ asset('images/background/user-info.jpg') }}) no-repeat;">
                        <!-- User profile image -->
                        <div class="profile-img"> <img src="{{ asset('images/users/profile.png') }}"  alt="user" /> </div>
                        <!-- User profile text-->
                        <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Olá, <b>{{ Auth::user()->name }}!</b></a>
                            <div class="dropdown-menu animated flipInY">
                                <a href="#" class="dropdown-item"><i class="ti-user"></i> Meu Perfil</a>
                                <a href="#" class="dropdown-item"><i class="ti-settings"></i> Configurações</a>
                                <div class="dropdown-divider"></div> <a href="{{ url('/logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Sair</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User profile text-->
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li>
                                <a class="waves-effect waves-dark" href="{{ url('/bpmn') }}" aria-expanded="false"><i class="mdi mdi-file-tree"></i><span class="hide-menu">BPMN 2.0 </span></a>    
                            </li>
                            <li>
                                <a class="waves-effect waves-dark" href="{{ url('/documentacao') }}" aria-expanded="false"><i class="mdi mdi-library-books"></i><span class="hide-menu">Documentação </span></a>    
                            </li>
                            <li>
                                <a class="waves-effect waves-dark" href="{{ url('/formularios') }}" aria-expanded="false"><i class="mdi mdi-file-document"></i><span class="hide-menu">Formulários </span></a>    
                            </li>
                            <li>
                                <a class="waves-effect waves-dark" href="{{ url('/configuracoes') }}" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Configurações </span></a>    
                            </li>
                            <li>
                                <a class="waves-effect waves-dark" href="{{ url('/teste') }}" aria-expanded="false"><i class="mdi mdi-air-conditioner"></i><span class="hide-menu">Teste - Form.io </span></a>    
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
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
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

    <!-- Scripts | Este é o script padrão/principal criado pelo próprio Laravel -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
</body>
</html>
