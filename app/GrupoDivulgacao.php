<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoDivulgacao extends Model
{
    
    protected $table = "grupo_divulgacao";

    protected $fillable = [
        'id', 'nome', 'descricao'
    ];

}
