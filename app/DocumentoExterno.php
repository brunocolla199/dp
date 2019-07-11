<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DocumentoExterno extends Model
{
    
    protected $table = "documento_externo";

    protected $fillable = [
        'id', 'id_documento', 'id_registro', 'id_area', 'validado', 'responsavel_upload_id', 'user_id', 'setor_id'
    ];


    public function getAprovadorAttribute() {
        return User::find($this->user_id)->name;
    }

    public function getResponsavelUploadAttribute() {
        return User::find($this->responsavel_upload_id)->name;
    }

}
