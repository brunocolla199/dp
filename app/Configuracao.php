<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    
    protected $table = "configuracao";

    protected $fillable = [
        'numero_padrao_codigo'
    ];

}
