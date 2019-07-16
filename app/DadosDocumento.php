<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosDocumento extends Model
{
    
    protected $table = 'dados_documento';

    protected $fillable = [
        'id', 'validade', 'status', 'observacao', 'copia_controlada', 'nivel_acesso', 'finalizado', 'necessita_revisao', 'id_usuario_solicitante', 'revisao', 'justificativa_rejeicao_revisao', 'em_revisao', 'justificativa_cancelar_revisao', 'setor_id', 'grupo_treinamento_id', 'grupo_divulgacao_id', 'elaborador_id', 'aprovador_id', 'documento_id', 'obsoleto', 'data_revisao', 'validade_anterior', 'data_revisao_anterior', 
    ];

}
