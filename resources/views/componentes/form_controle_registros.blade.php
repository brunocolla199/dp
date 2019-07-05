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
                {!! Form::text('meio_distribuicao', !is_null($registro) ? $registro->meio_distribuicao : null, ['class' => 'form-control', 'required' => 'required']) !!}
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
                {!! Form::text('local_armazenamento', !is_null($registro) ? $registro->local_armazenamento : null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-6 control-label font-bold">
                {!! Form::label('protecao', 'PROTEÇÃO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::text('protecao', !is_null($registro) ? $registro->protecao : null, ['class' => 'form-control', 'required' => 'required']) !!}
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
                {!! Form::text('recuperacao', !is_null($registro) ? $registro->recuperacao : null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-10 control-label font-bold">
                {!! Form::label('nivel_acesso', 'NÍVEL DE ACESSO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::select('nivel_acesso', $niveisAcesso, !is_null($registro) ? $registro->nivel_acesso : null, ['class' => 'form-control  custom-select', 'required' => 'required']) !!}
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
                {!! Form::text('tempo_retencao_local', !is_null($registro) ? $registro->tempo_retencao_local : null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
    </div> 
    <div class="col-md-6">
        <div class="form-group">
            <div class="col-md-12 control-label font-bold">
                {!! Form::label('tempo_retencao_deposito', 'RETENÇÃO MÍNIMA - ARQUIVO MORTO') !!}
            </div>
            <div class="col-md-12">
                {!! Form::text('tempo_retencao_deposito', !is_null($registro) ? $registro->tempo_retencao_deposito : '-', ['class' => 'form-control', 'required' => 'required']) !!}
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
                {!! Form::text('disposicao', !is_null($registro) ? $registro->disposicao : null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>
        </div>
    </div> 
    <div class="col-md-6 margin-top-1percent">
        <div class="col-md-12">
            <button type="submit" class="btn waves-effect waves-light btn-block btn-lg btn-secondary">{{ !is_null($registro) ? 'ATUALIZAR INFORMAÇÕES' : 'CRIAR REGISTRO' }}</button>
        </div>
    </div>
</div>