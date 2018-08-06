<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoDocumento extends Model
{
    
    protected $table = "historico_documento";
    
    protected $fillable = [
        'id', 'descricao', 'id_usuario_responsavel', 'nome_usuario_responsavel', 'documento_id'
    ];

}
