@extends('layouts.app')

@section('content')
    
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Credenciamento</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active">Credenciamento</li>
                    </ol>
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

                            <div class="row">
                                <div class="col-md-12">
                                    <section id="main_content" class="inner">
                                        <form class="build-form clearfix"></form>
                                        <div class="render-form"></div>
                                    </section>
                                    <div class="container render-btn-wrap">
                                        <button id="renderForm" class="btn btn-default">Preview Form</button>
                                        <button id="viewData" class="btn btn-default">console.log Data</button>
                                        <button id="reloadBtn" class="btn btn-default">Reset Editor</button>
                                    </div>
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
        <!-- ============================================================== -->
        <!-- End Container fluid -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper -->
    <!-- ============================================================== -->


  


@endsection



@section('footer')
    <script src="{{ asset('plugins/formeo/formeo.min.js') }}"></script>
    <script src="{{ asset('plugins/formeo/initFormeo.js') }}"></script>

    <script>
        initFormeo('', '{{ url("/") }}');
    </script>

@endsection