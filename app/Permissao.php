<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    
    protected $table = 'permissao';

    protected $fillable = [
        'id', 'nome', 'contador'
    ];

}
