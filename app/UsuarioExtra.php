<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioExtra extends Model
{
    
    protected $table = 'usuario_extra';

    protected $fillable = [
        'id', 'usuario_id', 'documento_id'
    ];

}
