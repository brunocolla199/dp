<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacaoFormulario extends Model
{
    protected $table = "notificacao_formulario";

    protected $fillable = [
        'id', 'texto', 'visualizada', 'necessita_interacao', 'usuario_id', 'formulario_id'
    ];
}
