<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoTreinamentoUsuario extends Model
{
    
    protected $table = "grupo_treinamento_usuario";

    protected $fillable = [
        'id', 'grupo_id', 'usuario_id'
    ];

}
