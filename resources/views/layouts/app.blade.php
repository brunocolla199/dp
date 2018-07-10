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
                                <img src="{{ asset('images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="{{ asset('images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span>
                            <!-- dark Logo text -->
                            <img src="{{ asset('images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->    
                            <img src="{{ asset('images/logo-light-text.png') }}" class="light-logo" alt="homepage" /></span> </a>
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
                                <!-- ============================================================== -->
                                <!-- Search -->
                                <!-- ============================================================== -->
                                <li class="nav-item hidden-sm-down search-box">
                                    <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                                    <form class="app-search">
                                        <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                                </li>
                                <!-- ============================================================== -->
                                <!-- Messages -->
                                <!-- ============================================================== -->
                                <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                                    <div class="dropdown-menu scale-up-left">
                                        <ul class="mega-dropdown-menu row">
                                            <li class="col-lg-3 col-xlg-2 m-b-30">
                                                <h4 class="m-b-20">CAROUSEL</h4>
                                                <!-- CAROUSEL -->
                                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active">
                                                            <div class="container"> <img class="d-block img-fluid" src="{{ asset('images/big/img1.jpg') }}" alt="First slide"></div>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <div class="container"><img class="d-block img-fluid" src="{{ asset('images/big/img2.jpg') }}" alt="Second slide"></div>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <div class="container"><img class="d-block img-fluid" src="{{ asset('images/big/img3.jpg') }}" alt="Third slide"></div>
                                                        </div>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                                </div>
                                                <!-- End CAROUSEL -->
                                            </li>
                                            <li class="col-lg-3 m-b-30">
                                                <h4 class="m-b-20">ACCORDION</h4>
                                                <!-- Accordian -->
                                                <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="headingOne">
                                                            <h5 class="mb-0">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Collapsible Group Item #1
                                                        </a>
                                                    </h5> </div>
                                                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high. </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="headingTwo">
                                                            <h5 class="mb-0">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Collapsible Group Item #2
                                                        </a>
                                                    </h5> </div>
                                                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="headingThree">
                                                            <h5 class="mb-0">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        Collapsible Group Item #3
                                                        </a>
                                                    </h5> </div>
                                                        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-lg-3  m-b-30">
                                                <h4 class="m-b-20">CONTACT US</h4>
                                                <!-- Contact -->
                                                <form>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" placeholder="Enter email"> </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-info">Submit</button>
                                                </form>
                                            </li>
                                            <li class="col-lg-3 col-xlg-4 m-b-30">
                                                <h4 class="m-b-20">List style</h4>
                                                <!-- List style -->
                                                <ul class="list-style-none">
                                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                                    <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- ============================================================== -->
                                <!-- End Messages -->
                                <!-- ============================================================== -->
                                
                                
                            </ul>
                            <!-- ============================================================== -->
                            <!-- User profile and search -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav my-lg-0">
                                <!-- ============================================================== -->
                                <!-- Comment -->
                                <!-- ============================================================== -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                        <ul>
                                            <li>
                                                <div class="drop-title">Notifications</div>
                                            </li>
                                            <li>
                                                <div class="message-center">
                                                    <!-- Message -->
                                                    <a href="#">
                                                        <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                        <div class="mail-contnet">
                                                            <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                                    </a>
                                                    <!-- Message -->
                                                    <a href="#">
                                                        <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                        <div class="mail-contnet">
                                                            <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                                    </a>
                                                    <!-- Message -->
                                                    <a href="#">
                                                        <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                        <div class="mail-contnet">
                                                            <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                                    </a>
                                                    <!-- Message -->
                                                    <a href="#">
                                                        <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                        <div class="mail-contnet">
                                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- ============================================================== -->
                                <!-- End Comment -->
                                <!-- ============================================================== -->
                                <!-- ============================================================== -->
                                <!-- Messages -->
                                <!-- ============================================================== -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                    </a>
                                    <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                        <ul>
                                            <li>
                                                <div class="drop-title">You have 4 new messages</div>
                                            </li>
                                            <li>
                                                <div class="message-center">
                                                    <!-- Message -->
                                                    <a href="#">
                                                        <div class="user-img"> <img src="{{ asset('images/users/1.jpg') }}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                        <div class="mail-contnet">
                                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                                    </a>
                                                    <!-- Message -->
                                                    <a href="#">
                                                        <div class="user-img"> <img src="{{ asset('images/users/2.jpg') }}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                                        <div class="mail-contnet">
                                                            <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                                    </a>
                                                    <!-- Message -->
                                                    <a href="#">
                                                        <div class="user-img"> <img src="{{ asset('images/users/3.jpg') }}" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                                        <div class="mail-contnet">
                                                            <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                                    </a>
                                                    <!-- Message -->
                                                    <a href="#">
                                                        <div class="user-img"> <img src="{{ asset('images/users/4.jpg') }}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                                        <div class="mail-contnet">
                                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- ============================================================== -->
                                <!-- End Messages -->
                                <!-- ============================================================== -->
                                
                                <!-- ============================================================== -->
                                <!-- Profile -->
                                <!-- ============================================================== -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('images/users/1.jpg') }}" alt="user" class="profile-pic" /></a>
                                    <div class="dropdown-menu dropdown-menu-right scale-up">
                                        <ul class="dropdown-user">
                                            <li>
                                                <div class="dw-user-box">
                                                    <div class="u-img"><img src="{{ asset('images/users/1.jpg') }}" alt="user"></div>
                                                    <div class="u-text">
                                                        <h4>Steave Jobs</h4>
                                                        <p class="text-muted">varun@gmail.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                                </div>
                                            </li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
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
