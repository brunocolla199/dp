@extends('layouts.app')

@section('content')  

	<div class="page-wrapper">
        <div class="container-fluid">

            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Configurações</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('configuracoes') }}">Configurações</a></li>
                        <li class="breadcrumb-item active">Vincular Usuários</li>
                    </ol>
                </div>
            </div>
            
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        
                            <h4 class="box-title">Clique sobre os usuários que deseja selecionar. <small>Caso todos os usuários do setor devam ser selecionados, clique sobre o nome do setor.</small></h4>
                            <select multiple id="optgroup" name="optgroup[]">
                                @foreach($setoresUsuarios as $key => $su)
                                    <optgroup label="{{$key}}">
                                        @foreach($su as $key2 => $user)
                                            <option value="{{$user}}">{{$user}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->



        </div>
    </div>
@endsection