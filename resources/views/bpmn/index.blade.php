@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">BPMN 2.0</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">BPMN 2.0</li>
                    </ol>
                </div>
            </div>
            
            
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
							<h3>BPMN 2.0</h3>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->


        </div>
    </div>
@endsection