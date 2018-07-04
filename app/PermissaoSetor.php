<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissaoSetor extends Model
{
    
    protected $table = 'permissao_setor';

    protected $fillable = [
        'id', 'setor_id', 'permissao_id'
    ];

}
