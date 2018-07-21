<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosDocumento extends Model
{
    
    protected $table = 'dados_documento';

    protected $fillable = [
        'id', 'validade', 'versao', 'status', 'observacao', 'copia_controlada', 'nivel_acesso', 'finalizado', 'setor_id', 'grupo_treinamento_id', 'grupo_divulgacao_id', 'aprovador_id', 'documento_id'
    ];

}
