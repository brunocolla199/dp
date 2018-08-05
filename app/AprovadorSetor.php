<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AprovadorSetor extends Model
{
    
    protected $table = "aprovador_setor";

    protected $fillable = [
        'id', 'usuario_id', 'setor_id'
    ];

}
