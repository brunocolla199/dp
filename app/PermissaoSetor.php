<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissaoSetor extends Model
{
    
    protected $fillable = [
        'id', 'setor_id', 'permissao_id'
    ];

}
