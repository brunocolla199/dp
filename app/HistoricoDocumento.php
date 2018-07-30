<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoDocumento extends Model
{
    
    protected $table = "historico_documento";
    
    protected $fillable = [
        'id', 'descricao', 'documento_id'
    ];

}
