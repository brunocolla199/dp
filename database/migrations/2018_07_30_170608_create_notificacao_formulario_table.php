<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacaoFormularioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacao_formulario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('texto', 100);
            $table->boolean('visualizada');
            $table->boolean('necessita_interacao');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->integer('formulario_id')->unsigned();
            $table->foreign('formulario_id')->references('id')->on('formulario');
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
        Schema::dropIfExists('notificacao_formulario');
    }
}
