<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    
    protected $table = 'workflow';

    protected $fillable = [
        'id', 'etapa', 'observacao', 'setor_id', 'documento_id'
    ];

}
