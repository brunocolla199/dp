<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDadosDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_documento', function (Blueprint $table) {
            $table->boolean('necessita_revisao')->default(false)->nullable();
            $table->integer('id_usuario_solicitante')->nullable();
            $table->string('revisao', 20)->nullable();
            $table->string('justificativa_rejeicao_revisao', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dados_documento', function (Blueprint $table) {
            $table->dropColumn('necessita_revisao');
            $table->dropColumn('id_usuario_solicitante');
            $table->dropColumn('revisao');
            $table->dropColumn('justificativa_rejeicao_revisao');
        });
    }
}
