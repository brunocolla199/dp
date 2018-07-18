@extends('layouts.app')

@section('content')  
    <!-- O que fazer nesta situação? -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

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
                        
                            <h4>Vinculando usuários <span class="text-info"> {{ $text_agrupamento }} </span> </h4>
                            <div class="col-md-12 alert alert-info">
                                <h5 class="box-title">Clique sobre os usuários que deseja vincular. <small>Caso deseje vincular todos os usuários do setor, clique sobre o nome do setor.</small></h5>
                                <h5 class="box-title">Para desvincular, selecione <b>um</b> usuário por vez. <small>Pedimos isso em razão da definição de um novo setor para cada usuário desvinculado.</small></h5>
                            </div>
                                
                            <div class="mt-4">
                                {!! Form::open(['route' => 'configuracoes.link.save', 'class' => 'form-horizontal', 'id' => 'form-generate-document']) !!}
                                    
                                
                                
                                    @if( isset($setor) )
                                        {!! Form::hidden('tipo_agrupamento', Constants::$ID_TIPO_AGRUPAMENTO_SETOR) !!}
                                        {!! Form::hidden('id_agrupamento', $setor->id) !!}
                                       
                                        <select multiple id="optgroup" name="usersLinked[]" data-setor="{{$setor->id}}">
                                            @foreach($setoresUsuarios as $key => $su)
                                                @if($key == $checkGrouping )
                                                    <optgroup label="{{$key}}">
                                                        @foreach($su as $key2 => $user)
                                                            <option selected value="{{$key2}}">{{$user}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <optgroup label="{{$key}}">
                                                        @foreach($su as $key2 => $user)
                                                            <option value="{{$key2}}">{{$user}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                            @endforeach
                                        </select>



                                    @elseif( isset($grupoT) )
                                        {!! Form::hidden('tipo_agrupamento', Constants::$ID_TIPO_AGRUPAMENTO_GRUPO_TREINAMENTO) !!}
                                        {!! Form::hidden('id_agrupamento', $grupoT->id) !!}

                                        <select multiple id="optgroup-grupoT" name="usersLinked[]" data-setor="{{$grupoT->id}}">
                                            @foreach($setoresUsuarios as $key => $su)
                                                <optgroup label="{{$key}}">
                                                    @foreach($su as $key2 => $user)
                                                        @if( in_array($user, $usuariosJaVinculados[$checkGrouping]) )
                                                            <option selected value="{{$key2}}">{{$user}}</option>
                                                        @else
                                                            <option value="{{$key2}}">{{$user}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>



                                    @elseif( isset($grupoD) )
                                        {!! Form::hidden('tipo_agrupamento', Constants::$ID_TIPO_AGRUPAMENTO_GRUPO_DIVULGACAO) !!}
                                        {!! Form::hidden('id_agrupamento', $grupoD->id) !!}

                                        <select multiple id="optgroup-grupoD" name="usersLinked[]" data-setor="{{$grupoD->id}}">
                                            @foreach($setoresUsuarios as $key => $su)
                                                <optgroup label="{{$key}}">
                                                    @foreach($su as $key2 => $user)
                                                        @if( in_array($user, $usuariosJaVinculados[$checkGrouping]) )
                                                            <option selected value="{{$key2}}">{{$user}}</option>
                                                        @else
                                                            <option value="{{$key2}}">{{$user}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>   
                                    @endif

                                    <div class="pull-right">
                                        <br>
                                        <input type="submit" id="btn-save-new-document" class="btn btn-lg btn-success" value="Atualizar Vinculações">
                                    </div>
                                {!! Form::close() !!}
                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->

            

        </div>
    </div>
@endsection