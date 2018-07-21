<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoFormulario extends Model
{
    
    protected $table = "documento_formulario";

    protected $fillable = [
        'id', 'documento_id', 'formulario_id'
    ];

}
