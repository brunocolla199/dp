<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    
    protected $fillable = [
        'nome', 'extensao', 'caminho', 'tipo_documento_id'
    ];

}
