<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentoExternoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_externo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_documento', 40);
            $table->string('id_registro', 40);
            $table->string('id_area', 40);
            $table->boolean('validado')->default(false);
            
            // Usuário que fez o upload do documento
            $table->integer('responsavel_upload_id')->unsigned();
            $table->foreign('responsavel_upload_id')->references('id')->on('users');
            
            // Usuário que marcar o 'checkbox' validado
            $table->integer('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')->references('id')->on('setor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_externo');
    }
}
