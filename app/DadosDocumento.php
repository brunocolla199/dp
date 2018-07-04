<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosDocumento extends Model
{
    
    protected $table = 'dados_documento';

    protected $fillable = [
        'id', 'validade', 'grupo_treinamento', 'grupo_divulgacao', 'versao', 'observacao', 'setor_id', 'documento_id'
    ];

}
