<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Constants;

class ControleRegistro extends Model
{
    
    protected $fillable = [
        'id', 'codigo', 'titulo', 'meio_distribuicao', 'local_armazenamento', 'protecao', 'recuperacao', 'nivel_acesso', 'tempo_retencao_local', 'tempo_retencao_deposito', 'disposicao', 'avulso', 'formulario_id', 'setor_id', 'local_armazenamento_id', 'disposicao_id', 'meio_distribuicao_id', 'protecao_id', 'recuperacao_id', 'tempo_retencao_deposito_id', 'tempo_retencao_local_id',
    ];


    /**
     * O setor desse registro
     */
    public function setor() {
        return $this->belongsTo('App\Setor');
    }


    /**
     * O formulário desse registro
     */
    public function formulario() {
        return $this->belongsTo('App\Formulario');
    }

    /**
     * Mutator - Título do formulário
     */
    public function getTituloAttribute($value) {
        return explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $value)[0];
    }

}
