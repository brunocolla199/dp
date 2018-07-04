<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    
    protected $table = 'setor';

    protected $fillable = [
        'id', 'nome', 'descricao'
    ];

}
