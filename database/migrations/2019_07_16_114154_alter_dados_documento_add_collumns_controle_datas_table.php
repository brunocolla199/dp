<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDadosDocumentoAddCollumnsControleDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_documento', function (Blueprint $table) {
            $table->date('validade_anterior')->nullable();
            $table->timestamp('data_revisao_anterior')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipos', function (Blueprint $table) {
            $table->dropColumn('validade_anterior');
            $table->dropColumn('data_revisao_anterior');
        });
    }
}
