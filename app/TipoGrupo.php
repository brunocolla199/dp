<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoGrupo extends Model
{
    
    protected $table = 'tipo_grupo';

    protected $fillable = [
        'id', 'nome'
    ];

}
