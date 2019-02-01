<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoTreinamentoDocumento extends Model
{
    
    protected $table = "grupo_treinamento_documento";

    protected $fillable = [
        'id', 'documento_id', 'usuario_id'
    ];

}
