<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    
    protected $table = 'workflow';

    protected $fillable = [
        'id', 'etapa_num', 'etapa', 'descricao', 'justificativa', 'documento_id'
    ];

}
