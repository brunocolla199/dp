<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopiaControladaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copia_controlada', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero_copias');
            $table->text('revisao', 10);
            $table->text('setor', 35);
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
        Schema::dropIfExists('copia_controlada');
    }
}
