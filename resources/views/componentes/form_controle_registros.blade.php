{{ csrf_field() }}

{!! Form::hidden('avulso', true) !!}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('codigo', 'CÓDIGO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::text('codigo', !is_null($registro) ? $registro->codigo : null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('titulo', 'TÍTULO/DESCRIÇÃO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::text('titulo', !is_null($registro) ? $registro->titulo : null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-10 control-label font-bold">
                {!! Form::label('setor_id', 'RESPONSÁVEL') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('setor_id', $setores, !is_null($registro) ? $registro->setor_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('meio_distribuicao', 'MEIO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('meio_distribuicao', Constants::$CONTROLE_REGISTROS_MEIO, !is_null($registro) ? $registro->meio_distribuicao : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('local_armazenamento', 'ARMAZENAMENTO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('local_armazenamento', Constants::$CONTROLE_REGISTROS_ARMAZENAMENTO, !is_null($registro) ? $registro->local_armazenamento : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('protecao', 'PROTEÇÃO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('protecao', Constants::$CONTROLE_REGISTROS_PROTECAO, !is_null($registro) ? $registro->protecao : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('recuperacao', 'RECUPERAÇÃO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('recuperacao', Constants::$CONTROLE_REGISTROS_RECUPERACAO, !is_null($registro) ? $registro->recuperacao : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-10 control-label font-bold">
                {!! Form::label('nivel_acesso', 'NÍVEL DE ACESSO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('nivel_acesso', $niveisAcesso, !is_null($registro) ? $registro->nivel_acesso : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-12 control-label font-bold">
                {!! Form::label('tempo_retencao_local', 'RETENÇÃO MÍNIMA - LOCAL') !!}
            </div>
            <div class="col-md-12">                
                <select name="tempo_retencao_local" class="select2 m-b-10 select2-multiple" style="width: 100%" data-placeholder="Escolha..." required="required">
                    @foreach (Constants::$CONTROLE_REGISTROS_RETENCAO_LOCAL as $key => $item)
                        <optgroup label="{{ $key }}">
                            @if ( !is_null($registro) )
                                @foreach ($item as $key => $opt)
                                    <option value="{{ $key }}" {{ $key == $registro->tempo_retencao_local ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach  
                            @else
                                @foreach ($item as $key => $opt)
                                    <option value="{{ $key }}">{{ $opt }}</option>
                                @endforeach
                            @endif
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-12 control-label font-bold">
                {!! Form::label('tempo_retencao_deposito', 'RETENÇÃO MÍNIMA - ARQUIVO MORTO') !!}
            </div>
            <div class="col-md-12">
                <select name="tempo_retencao_deposito" class="select2 m-b-10 select2-multiple" style="width: 100%" data-placeholder="Escolha..." required="required">
                    @foreach (Constants::$CONTROLE_REGISTROS_RETENCAO_ARQUIVO_MORTO as $key => $item)
                        <optgroup label="{{ $key }}">
                            @if ( !is_null($registro) )
                                @foreach ($item as $key => $opt)
                                    <option value="{{ $key }}" {{ $key == $registro->tempo_retencao_deposito ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach  
                            @else
                                @foreach ($item as $key => $opt)
                                    <option value="{{ $key }}">{{ $opt }}</option>
                                @endforeach
                            @endif
                        </optgroup>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('disposicao', 'DISPOSIÇÃO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('disposicao', Constants::$CONTROLE_REGISTROS_DISPOSICAO, !is_null($registro) ? $registro->disposicao : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div> 
    <div class="col-md-6 margin-top-1percent">
        <div class="col-md-12">
            <button type="submit" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">{{ !is_null($registro) ? 'ATUALIZAR INFORMAÇÕES' : 'CRIAR REGISTRO' }}</button>
        </div>
    </div>
</div>