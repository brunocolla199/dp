<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    
    protected $table = 'grupo';

    protected $fillable = [
        'id', 'nome', 'descricao', 'tipo_grupo_id'
    ];

}
