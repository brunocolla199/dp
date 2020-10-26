<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSizeColumnsDadosDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_documento', function (Blueprint $table) {
            $table->text('justificativa_cancelar_revisao')->change();
            $table->text('justificativa_rejeicao_revisao')->change();
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
            $table->string('justificativa_cancelar_revisao', 200)->change();
            $table->string('justificativa_rejeicao_revisao', 200)->change();
        });
    }
}
