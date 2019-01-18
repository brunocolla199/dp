<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CopiaControlada extends Model
{
    
    protected $table = 'copia_controlada';

    protected $fillable = [
        'id', 'numero_copias', 'revisao', 'setor', 'documento_id'
    ];

}
