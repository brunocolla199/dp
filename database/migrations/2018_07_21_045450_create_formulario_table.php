<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormularioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 80);
            $table->string('codigo', 80);
            $table->string('extensao', 10);
            $table->text('conteudo')->nullable();
            $table->string('nivel_acesso', 20);
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
        Schema::dropIfExists('formulario');
    }
}
