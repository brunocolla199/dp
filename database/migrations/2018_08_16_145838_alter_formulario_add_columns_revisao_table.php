<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFormularioAddColumnsRevisaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formulario', function (Blueprint $table) {
            $table->string('revisao', 20)->nullable();
            $table->boolean('em_revisao')->default(false);
            $table->integer('id_usuario_solicitante')->nullable();
            $table->string('nome_completo_finalizado', 200)->nullable();
            $table->string('nome_completo_em_revisao', 200)->nullable();
            $table->string('justificativa_cancelar_revisao', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formulario', function (Blueprint $table) {
            $table->dropColumn('revisao');
            $table->dropColumn('em_revisao');
            $table->dropColumn('id_usuario_solicitante');
            $table->dropColumn('nome_completo_finalizado');
            $table->dropColumn('nome_completo_em_revisao');
            $table->dropColumn('justificativa_cancelar_revisao');
        });
    }
}
