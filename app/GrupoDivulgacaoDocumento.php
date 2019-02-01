<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoDivulgacaoDocumento extends Model
{
    
    protected $table = "grupo_divulgacao_documento";

    protected $fillable = [
        'id', 'documento_id', 'usuario_id'
    ];

}
