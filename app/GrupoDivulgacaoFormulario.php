<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoDivulgacaoFormulario extends Model
{
    
    protected $table = "grupo_divulgacao_formulario";

    protected $fillable = [
        'id', 'formulario_id', 'usuario_id'
    ];

}
