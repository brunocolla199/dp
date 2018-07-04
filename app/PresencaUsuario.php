<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresencaUsuario extends Model
{
    
    protected $table = 'presenca_usuario';

    protected $fillable = [
        'id', 'lista_presenca_id', 'usuario_id'
    ];

}
