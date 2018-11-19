@extends('layouts.app')

@section('content')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"  rel="stylesheet">
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>



	<div class="page-wrapper">
        <div class="container-fluid">
            

            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Documentação</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::route('documentacao') }}">Documentação</a></li>
                        <li class="breadcrumb-item active">Atualizar Informações</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="">
                        <button class="right-side-toggle waves-light btn-success btn btn-circle btn-xl pull-right m-l-10   btn-badge badge-top-right" data-count="{{ count(\App\Classes\Helpers::instance()->getNotifications( Auth::user()->id )) }}">
                            <i class="ti-comment-alt text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Atualizando informações do documento: <span class="text-themecolor">{{ $documento->nome }}</span></h3>
                            
                            {!! Form::open(['route' => 'documentacao.update-info', 'class' => 'form-horizontal', 'id' => 'form-generate-document']) !!}
                                {!! Form::hidden('doc_id', $documento->id) !!}

                                <!-- Linha 1 -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-6 control-label font-bold">
                                                {!! Form::label('aprovadores', 'APROVADORES:') !!}
                                            </div>
                                            <div class="col-md-12">

                                                {!! Form::select('aprovador', $aprovadores, $documento->aprovador_id, ['class' => 'form-control  custom-select', 'id' => 'aprovadores']) !!}
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-10 control-label font-bold">
                                                {!! Form::label('copiaControlada', 'CÓPIA CONTROLADA:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                <input name="copiaControlada" type="radio" id="sim" value="true" class="with-gap radio-col-blue" {{ ($documento->copia_controlada) ? 'checked' : '' }} />
                                                <label for="sim">Sim</label>
                                                <input name="copiaControlada" type="radio" id="nao" value="false" class="with-gap radio-col-light-blue" {{ ($documento->copia_controlada) ? '' : 'checked' }}/>
                                                <label for="nao">Não</label>
                                            </div>
                                        </div>
                                    </div>   
                                </div>

                                <!-- Linha 3 -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-10 control-label font-bold">
                                                {!! Form::label('areaInteresse', 'ÁREA DE INTERESSE:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                <select multiple id="optgroup-newAreaDeInteresse-update" name="areaInteresse[]">
                                                    @foreach($setoresUsuarios as $key => $su)
                                                        <optgroup label="{{ $key }}">
                                                            @foreach($su as $key2 => $user)
                                                                @if( in_array($key2, $usuariosAreaInteresseDocumento) )
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


                                @if( $documento->nivel_acesso == Constants::$NIVEL_ACESSO_DOC_RESTRITO || $documento->nivel_acesso == Constants::$NIVEL_ACESSO_DOC_CONFIDENCIAL )
                                    <!-- Linha 4 -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-10 control-label font-bold">
                                                    {!! Form::label('extraUsers', 'USUÁRIOS EXTRAS:') !!}
                                                </div>
                                                <div class="col-md-12">
                                                    <select multiple id="optgroup-newExtraUsers" name="extraUsers[]">
                                                        @foreach($setoresUsuarios as $key => $su)
                                                            <optgroup label="{{ $key }}">
                                                                @foreach($su as $key2 => $user)
                                                                    @if( in_array($key2, $usuariosExtraDocumento) )
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
                                @endif


                                <!-- Linha 5 --> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-10 control-label font-bold">
                                                {!! Form::label('grupoTreinamento', 'GRUPO DE TREINAMENTO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('grupoTreinamento', $gruposTreinamento, $documento->grupo_treinamento_id, ['class' => 'form-control  custom-select']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-10 control-label font-bold">
                                                {!! Form::label('grupoDivulgacao', 'GRUPO DE DIVULGAÇÃO:') !!}
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::select('grupoDivulgacao', $gruposDivulgacao, $documento->grupo_divulgacao_id, ['class' => 'form-control  custom-select']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Linha 6 --> 
                                <div class="row">
                                    <div class="col-md-6">
                                        @if( Auth::user()->permissao_elaborador || Auth::user()->setor_id == Constants::$ID_SETOR_QUALIDADE )
                                            <div class="form-group">
                                                <div class="col-md-10 control-label font-bold">
                                                    {!! Form::label('validadeDocumento', 'VALIDADE DO DOCUMENTO:') !!}
                                                </div>
                                                <div class="col-md-12">
                                                    {!! Form::text('validadeDocumento', \Carbon\Carbon::createFromFormat('Y-m-d', $documento->validade)->format('d/n/Y'), ['class' => 'form-control', 'id' => 'mdate']) !!}
                                                </div>
                                            </div>
                                        @else 
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <h6>A validade só pode ser alterada por um usuário do setor Qualidade ou que possua a <i>permissão de elaborador</i>. </h6>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">ATUALIZAR INFORMAÇÕES</button>
                                        </div>
                                    </div>
                                </div>    
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->


        </div>
    </div>
@endsection


@section('footer')
    <script src="{{ asset('plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('plugins/quicksearch/jquery.quicksearch.js') }}"></script>
    <script>        
        $(function(){

            // Material Date picker   
            $('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: new Date(), lang: 'pt-br', format: 'DD/M/YYYY', currentDate: new Date(), cancelText: 'Cancelar', okText: 'Definir' });


            /*
            * 
            * MultiSelect de NOVA ÁREA DE INTERESSE - UPDATE
            *
            */
            $('#optgroup-newAreaDeInteresse-update').multiSelect({
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


            /*
            * 
            * MultiSelect de USUÁRIOS EXTRAS (Para poder permitir outras pessoas de ver o documento)
            *
            */
            $('#optgroup-newExtraUsers').multiSelect({
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

        });
    </script>
@endsection
