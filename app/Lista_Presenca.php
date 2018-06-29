<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista_Presenca extends Model
{
    
    protected $fillable = [
        'data', 'descricao', 'documento_id'
    ];

}
