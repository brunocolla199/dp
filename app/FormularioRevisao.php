<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormularioRevisao extends Model
{
    
    protected $table = "formulario_revisao";

    protected $fillable = [
        'id', 'codigo', 'revisao', 'nome', 'nome_completo',  'extensao', 'nivel_acesso', 'finalizado', 'tipo_documento_id', 'elaborador_id', 'setor_id', 'grupo_divulgacao_id', 'documentos_necessitam'
    ];

}
