<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcoesControleRegistros extends Model
{
    
    protected $table = "opcoes_controle_registros";

    protected $fillable = [
        'id', 'campo', 'descricao', 'ativo'
    ];

}
