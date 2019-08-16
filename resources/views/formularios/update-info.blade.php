@extends('layouts.app')

@section('content')
	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-9 col-9 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Visualização de Formulário</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('formularios') }}">Formulários</a></li>
                        <li class="breadcrumb-item active">Atualizar Informações</li>
                    </ol>
                </div>               
            </div>
            
            
            <!-- Start Page Content -->
            <div class="row">

                <!-- Card Principal -->
                <div class="col-12">
                    <div class="card">
                        <div class=" card-body">

                            <!-- Alertas - Validação do Form -->
                            @if(Session::has('message'))
                                <div class="alert alert-{{str_before(Session::get('style'), '|')}}"> <i class="mdi mdi-{{str_after(Session::get('style'), '|')}}"></i> {{ Session::get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                            @endif

                            {!! Form::open(['route' => 'formularios.update-info', 'method' => 'POST', 'id' => 'form-save-new-document']) !!}
                                {{ csrf_field() }}
                                {!! Form::hidden('form_id', $formulario->id) !!}
                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('tituloFormulario', 'TÍTULO DO FORMULÁRIO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::text('tituloFormulario', $formulario->nome, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <div class="col-md-10 control-label font-bold">
                                                {!! Form::label('nivelAcessoFormulario', 'NÍVEL DE ACESSO AO DOCUMENTO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('nivelAcessoFormulario', [Constants::$NIVEL_ACESSO_DOC_LIVRE, Constants::$NIVEL_ACESSO_DOC_RESTRITO], $formulario->nivel_acesso_fake_id, ['class' => 'form-control  custom-select']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-10 control-label font-bold">
                                                {!! Form::label('areaInteresse', 'GRUPO DE DIVULGAÇÃO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                <select multiple id="optgroup-newGrupoDivulgacaoFormulario-update" name="grupoDivulgacaoFormularioUPDATE[]">
                                                    @foreach($setoresUsuarios as $key => $su)
                                                        <optgroup label="{{ $key }}">
                                                            @foreach($su as $key2 => $user)
                                                                @if( in_array($key2, $usuarioExistentesGrupoDivulgacaoFormulario) )
                                                                    <option selected value="{{ $key2 }}">{{ $user }}</option>
                                                                @else
                                                                    <option value="{{ $key2 }}">{{ $user }}</option>
                                                                @endif
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>   
                                    </div>                                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('meio_distribuicao_id', 'MEIO') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('meio_distribuicao_id', $meiosDistribuicao, !is_null($registro) ? $registro->meio_distribuicao_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('local_armazenamento_id', 'ARMAZENAMENTO') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('local_armazenamento_id', $locaisArmazenamento, !is_null($registro) ? $registro->local_armazenamento_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('protecao_id', 'PROTEÇÃO') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('protecao_id', $protecao, !is_null($registro) ? $registro->protecao_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('recuperacao_id', 'RECUPERAÇÃO') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('recuperacao_id', $recuperacao, !is_null($registro) ? $registro->recuperacao_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <div class="col-md-12 control-label font-bold">
                                                {!! Form::label('tempo_retencao_local_id', 'RETENÇÃO MÍNIMA - LOCAL') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('tempo_retencao_local_id', $tempoRetLocal, !is_null($registro) ? $registro->tempo_retencao_local_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <div class="col-md-12 control-label font-bold">
                                                {!! Form::label('tempo_retencao_deposito_id', 'RETENÇÃO MÍNIMA - ARQUIVO MORTO') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('tempo_retencao_deposito_id', $tempoRetDeposito, !is_null($registro) ? $registro->tempo_retencao_deposito_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('disposicao', 'DISPOSIÇÃO') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('disposicao_id', $disposicao, !is_null($registro) ? $registro->disposicao_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
                                            </div>
                                        </div>    
                                    </div>    
                                    <div class="col-md-6">
                                        <div class="col-md-12 mt-3">
                                            <button type="submit" class="btn waves-effect waves-light btn-block btn-lg btn-secondary" >ATUALIZAR INFORMAÇÕES</button>
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
    
    
    
@section('footer')
    
    <script src="{{ asset('plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('plugins/quicksearch/jquery.quicksearch.js') }}"></script>

    <script>
        $(".select2-selection").css('min-height', '38px');
        $(".select2-selection__rendered").css('line-height', '38px');
    </script>
    
    <script>
        /*
        * MultiSelect de atualização de GRUPO DE DIVULGAÇÃO PARA O FORMULÁRIO
        */
        $('#optgroup-newGrupoDivulgacaoFormulario-update').multiSelect({
            selectableOptgroup: true,
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Pesquisar usuários'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='Pesquisar usuários'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function(e){
                if (e.which === 40){
                    that.$selectableUl.focus();
                    return false;
                }
                });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function(e){
                if (e.which == 40){
                    that.$selectionUl.focus();
                    return false;
                }
                });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(values){
                this.qs1.cache();
                this.qs2.cache();
            }
        });
    </script>
    
@endsection