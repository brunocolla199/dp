<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkflowFormulario extends Model
{
    
    protected $table = "workflow_formulario";

    protected $fillable = [
        'id', 'etapa_num', 'etapa', 'descricao', 'justificativa', 'formulario_id'
    ];

}
