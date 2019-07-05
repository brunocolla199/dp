<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControleRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controle_registros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 20);
            $table->string('titulo', 350);
            $table->string('meio_distribuicao', 150);
            $table->string('local_armazenamento', 150);
            $table->string('protecao', 150);
            $table->string('recuperacao', 150);
            $table->string('nivel_acesso', 20);
            $table->string('tempo_retencao_local', 150);
            $table->string('tempo_retencao_deposito', 150);
            $table->string('disposicao', 150);
            $table->boolean('avulso');
            $table->integer('formulario_id')->nullable();
            $table->foreign('formulario_id')->references('id')->on('formulario');
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
        Schema::dropIfExists('controle_registros');
    }
}
