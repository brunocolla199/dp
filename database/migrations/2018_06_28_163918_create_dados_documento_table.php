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
            $table->text('grupo_treinamento');
            $table->text('grupo_divulgacao');
            $table->double('versao', 8, 2);
            $table->text('observacao');
            $table->integer('setor_id')->unsigned(); // No DiaPortable, esta coluna está apresentada como 'id_aprovador' e 'id_area_interesse', mas eu achei mais prudente deixar o nome da tabela, não um possível valor da mesma
            $table->foreign('setor_id')->references('id')->on('setor'); // No DiaPortable, esta coluna está apresentada como 'id_aprovador' e 'id_area_interesse', mas eu achei mais prudente deixar o nome da tabela, não um possível valor da mesma
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
