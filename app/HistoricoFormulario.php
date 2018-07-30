<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoFormulario extends Model
{
    
    protected $table = "historico_formulario";
    
    protected $fillable = [
        'id', 'descricao', 'formulario_id'
    ];

}
