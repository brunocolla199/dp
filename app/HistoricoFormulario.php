<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoFormulario extends Model
{
    
    protected $table = "historico_formulario";
    
    protected $fillable = [
        'id', 'descricao', 'id_usuario_responsavel', 'nome_usuario_responsavel', 'formulario_id'
    ];

}
