<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresencaUsuario extends Model
{
    
    protected $fillable = [
        'id', 'lista_presenca_id', 'usuario_id'
    ];

}
