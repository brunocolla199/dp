<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowFormularioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_formulario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('etapa_num')->unsigned();
            $table->string('etapa', 50);
            $table->string('descricao', 100);
            $table->string('justificativa', 300);
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
        Schema::dropIfExists('workflow_formulario');
    }
}
