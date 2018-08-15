<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDadosDocumentoAddColumnsCancelarRevisaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_documento', function (Blueprint $table) {
            $table->boolean('em_revisao')->default(false)->nullable();
            $table->string('justificativa_cancelar_revisao', 500)->nullable();
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
            $table->dropColumn('em_revisao');
            $table->dropColumn('justificativa_cancelar_revisao');
        });
    }
}
