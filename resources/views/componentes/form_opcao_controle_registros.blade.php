<div class="form-group row">
    <label for="campo" class="col-sm-3 text-right control-label col-form-label">Campo</label>
    <div class="col-sm-7">
        {!! Form::select('campo', Constants::$CONTROLE_REGISTROS, isset($option) ? $option->campo : null, ['class' => 'form-control custom-select', 'id' => 'campo', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="descricao" class="col-sm-3 text-right control-label col-form-label">Descrição</label>
    <div class="col-sm-7">
        {!! Form::text('descricao', isset($option) ? $option->descricao : null, ['class' => 'form-control', 'id' => 'descricao', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="ativo" class="col-sm-3 text-right control-label col-form-label">Ativo</label>
    <div class="col-sm-7 mt-1">
        <div class="switch">
            <label>NÃO
                @if(isset($option))
                    <input name="ativo" type="checkbox" {{ $option->ativo ? 'checked' : '' }}>
                @else
                    <input name="ativo" type="checkbox" checked>
                @endisset
                <span class="lever"></span>SIM
            </label>
        </div>
    </div>
</div>