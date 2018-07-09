<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    
    protected $table = 'setor';

    protected $fillable = [
        'id', 'nome', 'sigla', 'descricao', 'tipo_setor_id'
    ];

    public function getNomeSiglaAttribute() {
        return $this->nome.';'.$this->sigla;  
    }

}
