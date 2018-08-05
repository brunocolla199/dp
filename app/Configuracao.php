<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    
    protected $table = "configuracao";

    protected $fillable = [
        'id', 'numero_padrao_codigo', 'admin_setor_qualidade'
    ];

}
