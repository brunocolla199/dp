@extends('layouts.app')

@section('content')

    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Documentos Externos</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('fornecedores.index') }}">Fornecedores</a></li>
                        <li class="breadcrumb-item active">Novo</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-light btn-success btn btn-circle btn-xl pull-right m-l-10  btn-badge badge-top-right" data-count="{{ count(\App\Classes\Helpers::instance()->getNotifications( Auth::user()->id )) }}">
                            <i class="ti-comment-alt text-white"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if(Session::has('message'))
                                <div class="alert alert-{{str_before(Session::get('style'), '|')}}"> <i class="mdi mdi-{{str_after(Session::get('style'), '|')}}"></i> {{ Session::get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                            @endif

                            {!! Form::open(['route' => 'fornecedores.alterar', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$fornecedor->id}}"/>

                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group required">
                                                    <div class="col-md-12 control-label font-bold">
                                                        {!! Form::label('nome', 'Nome do Fornecedor:') !!}
                                                    </div>
                                                    <div class="col-md-12">
                                                        {!! Form::text('nome', $fornecedor->nome, ['class' => 'form-control', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>     
                                            <div class="col-md-6 margin-top-1percent">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn waves-effect waves-light btn-block btn-lg btn-secondary" >ATUALIZAR FORNECEDOR</button>
                                                </div>
                                            </div>
                                        </div>     
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
