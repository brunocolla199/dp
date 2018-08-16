<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    
    protected $table = "anexo";

    protected $fillable = [
        'id', 'nome', 'hash', 'extensao', 'documento_id'
    ];

}
