<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissaoSetorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissao_setor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')->references('id')->on('setor');
            $table->integer('permissao_id')->unsigned();
            $table->foreign('permissao_id')->references('id')->on('permissao');
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
        Schema::dropIfExists('permissao_setor');
    }
}
