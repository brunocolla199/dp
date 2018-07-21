<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    
    protected $table = "formulario";

    protected $fillable = [
        'id', 'nome', 'codigo', 'conteudo', 'nivel_acesso', 'setor_id', 'grupo_divulgacao_id'
    ];

}
