<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presenca_Usuario extends Model
{
    
    protected $fillable = [
        'id', 'lista_presenca_id', 'usuario_id'
    ];

}
