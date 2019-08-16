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
                {!! Form::label('meio_distribuicao_id', 'MEIO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('meio_distribuicao_id', $meiosDistribuicao, !is_null($registro) ? $registro->meio_distribuicao_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('local_armazenamento_id', 'ARMAZENAMENTO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('local_armazenamento_id', $locaisArmazenamento, !is_null($registro) ? $registro->local_armazenamento_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('protecao_id', 'PROTEÇÃO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('protecao_id', $protecao, !is_null($registro) ? $registro->protecao_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('recuperacao_id', 'RECUPERAÇÃO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('recuperacao_id', $recuperacao, !is_null($registro) ? $registro->recuperacao_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
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
                {!! Form::label('tempo_retencao_local_id', 'RETENÇÃO MÍNIMA - LOCAL') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('tempo_retencao_local_id', $tempoRetLocal, !is_null($registro) ? $registro->tempo_retencao_local_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div> 
    <div class="col-md-6">
        <div class="form-group">
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
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('disposicao_id', 'DISPOSIÇÃO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('disposicao_id', $disposicao, !is_null($registro) ? $registro->disposicao_id : null, ['class' => 'form-control custom-select', 'required' => 'required']) !!}
            </div>
        </div>
    </div> 
    <div class="col-md-6 margin-top-1percent">
        <div class="col-md-12">
            <button type="submit" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">{{ !is_null($registro) ? 'ATUALIZAR INFORMAÇÕES' : 'CRIAR REGISTRO' }}</button>
        </div>
    </div>
</div>