<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dados_Documento extends Model
{
    
    protected $fillable = [
        'id', 'validade', 'grupo_treinamento', 'grupo_divulgacao', 'versao', 'observacao', 'setor_id', 'documento_id'
    ];

}
