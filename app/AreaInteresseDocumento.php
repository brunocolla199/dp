<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaInteresseDocumento extends Model
{
    
    protected $table = "area_interesse_documento";

    protected $fillable = [
        'id', 'documento_id', 'usuario_id'
    ];

}
