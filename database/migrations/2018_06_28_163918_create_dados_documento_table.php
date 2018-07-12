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
            $table->double('versao', 8, 2);
            $table->boolean('status');
            $table->text('observacao');
            $table->integer('tipo_grupo_interesse')->unsigned();  // 1 = Usuário; 2 = Setor
            $table->integer('grupo_interesse_id')->unsigned();
            $table->foreign('grupo_interesse_id')->references('id')->on('setor');
            $table->integer('grupo_treinamento_id')->unsigned();
            $table->foreign('grupo_treinamento_id')->references('id')->on('setor');
            $table->integer('grupo_divulgacao_id')->unsigned();
            $table->foreign('grupo_divulgacao_id')->references('id')->on('setor');
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
