<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CopiaControlada extends Model
{
    
    protected $table = 'copia_controlada';

    protected $fillable = [
        'id', 'numero_copias', 'revisao', 'setor', 'documento_id', 'usuario_id'
    ];

    /** O usuário 'responsável' pela substituição da cópia física */
    public function user() {
        return $this->belongsTo('App\User', 'usuario_id');
    }

    public function getResponsavelAttribute() {
        return $this->user->name;
    }

}
