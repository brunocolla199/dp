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
            <div class="col-md-7 col-4 align-self-center">
                <div class="">
                    <a href="{{ URL::route('documentacao') }}" class="waves-effect waves-light btn-success btn btn-circle btn-xl pull-right m-l-10" data-toggle="tooltip" title="Retornar aos Documentos" style="position: fixed; bottom: 20px; right: 20px; padding: 25px;">
                        <i class="ti-home text-white" style="position: absolute; top: 22px; left: 22px;"></i>
                    </a>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="fix-width">
                <div class="row p-t-30">
                    <div class="col-12">
                        <!-- card -->
                        <div class="card" id="introducao">
                            <div class="card-body">
                                <h3>Introdução</h3>

                            </div>
                        </div>

                        <!-- card -->
                        <div class="card" id="apresentacao">
                            <div class="card-body">
                                

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
