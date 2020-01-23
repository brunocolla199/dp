<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    
    protected $table = 'documento';

    protected $fillable = [
        'id', 'nome', 'codigo', 'extensao', 'tipo_documento_id'
    ];

    public function dados()
    {
        return $this->hasOne('\App\DadosDocumento', 'documento_id');
    }
}
