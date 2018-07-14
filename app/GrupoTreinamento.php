<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoTreinamento extends Model
{
    
    protected $table = "grupo_treinamento";

    protected $fillable = [
        'id', 'nome', 'descricao'
    ];
}
