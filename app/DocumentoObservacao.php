<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoObservacao extends Model
{
    
    protected $table = "documento_observacao";

    protected $fillable = [
        'id', 'observacao', 'nome_usuario_responsavel', 'documento_id', 'usuario_id'
    ];

}
