<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCopiaControladaAddColumnResponsavelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('copia_controlada', function (Blueprint $table) {
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');;
            
            $table->integer('numero_copias')->nullable()->change();
            $table->text('revisao', 10)->nullable()->change();
            $table->text('setor', 35)->nullable()->change();
        });


        Schema::table('lista_presenca', function (Blueprint $table) {
            $table->string('nome', 350)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('copia_controlada', function (Blueprint $table) {
            $table->dropColumn('usuario_id');
        });
    }
}
