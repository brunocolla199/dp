<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoDivulgacaoUsuario extends Model
{
    
    protected $table = "grupo_divulgacao_usuario";

    protected $fillable = [
        'id', 'grupo_id', 'usuario_id'
    ];

}
