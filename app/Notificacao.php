<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    
    protected $table = "notificacao";

    protected $fillable = [
        'id', 'texto', 'visualizada', 'necessita_interacao', 'usuario_id', 'documento_id'
    ];

}
