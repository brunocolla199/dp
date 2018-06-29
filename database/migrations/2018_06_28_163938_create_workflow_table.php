<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkflowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow', function (Blueprint $table) {
            $table->increments('id');
            $table->string('etapa', 50);
            $table->text('observacao');
            $table->integer('setor_id')->unsigned();
            $table->foreign('setor_id')->references('id')->on('setor');
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
        Schema::dropIfExists('workflow');
    }
}
