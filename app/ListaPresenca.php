<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaPresenca extends Model
{
    
    protected $fillable = [
        'data', 'descricao', 'documento_id'
    ];

}
