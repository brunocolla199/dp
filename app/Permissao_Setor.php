<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao_Setor extends Model
{
    
    protected $fillable = [
        'id', 'setor_id', 'permissao_id'
    ];

}
