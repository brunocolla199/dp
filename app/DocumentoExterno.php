<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DocumentoExterno extends Model
{
    
    protected $table = "documento_externo";

    protected $fillable = [
        'id',
        'id_documento',
        'id_registro',
        'id_area',
        'validado',
        'responsavel_upload_id',
        'user_id',
        'setor_id',
        'fornecedor_id',
        'revisao',
        'validade',
    ];


    public function getAprovadorAttribute()
    {
        return User::find($this->user_id)->name;
    }

    
    public function getResponsavelUploadAttribute()
    {
        return User::find($this->responsavel_upload_id)->name;
    }


    public function fornecedor()
    {
        return $this->hasOne('App\Fornecedor', 'id', 'fornecedor_id');
    }


    public function setor()
    {
        return $this->hasOne('App\Setor', 'id', 'setor_id');
    }
}
