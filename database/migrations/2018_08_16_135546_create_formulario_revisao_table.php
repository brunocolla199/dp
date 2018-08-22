<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormularioRevisaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulario_revisao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 10);
            $table->string('revisao', 3);
            $table->string('nome', 250);
            $table->string('nome_completo', 254);
            $table->string('extensao', 5);
            $table->string('nivel_acesso', 80);
            $table->boolean('finalizado');
            $table->string('documentos_necessitam', 80)->nullable();                                            // VARCHAR com os ids dos documentos que vincularam esse form e "necessitam" do mesmo  =)
            $table->integer('formulario_id')->unsigned();
            $table->foreign('formulario_id')->references('id')->on('formulario');
            $table->integer('tipo_documento_id')->unsigned();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento');
            $table->integer('elaborador_id')->unsigned();
            $table->foreign('elaborador_id')->references('id')->on('users');
            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')->references('id')->on('setor');
            $table->integer('grupo_divulgacao_id')->unsigned();
            $table->foreign('grupo_divulgacao_id')->references('id')->on('grupo_divulgacao');
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
        Schema::dropIfExists('formulario_revisao');
    }
}
