<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_documento', function (Blueprint $table) {
            $table->increments('id');
            $table->date('validade');
            $table->boolean('status');
            $table->text('observacao');
            $table->boolean('copia_controlada');
            $table->string('nivel_acesso', 20);
            $table->boolean('finalizado');
            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')->references('id')->on('setor');
            $table->integer('grupo_treinamento_id')->unsigned();
            $table->foreign('grupo_treinamento_id')->references('id')->on('grupo_treinamento');
            $table->integer('grupo_divulgacao_id')->unsigned();
            $table->foreign('grupo_divulgacao_id')->references('id')->on('grupo_divulgacao');
            $table->integer('elaborador_id')->unsigned();
            $table->foreign('elaborador_id')->references('id')->on('users');
            $table->integer('aprovador_id')->unsigned();
            $table->foreign('aprovador_id')->references('id')->on('users');
            $table->integer('documento_id')->unsigned();
            $table->foreign('documento_id')->references('id')->on('documento');
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
        Schema::dropIfExists('dados_documento');
    }
}
