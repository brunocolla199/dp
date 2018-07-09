<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSetor extends Model
{
    
    protected $table = "tipo_setor";

    protected $fillable = [
        'id', 'nome'
    ];

}
