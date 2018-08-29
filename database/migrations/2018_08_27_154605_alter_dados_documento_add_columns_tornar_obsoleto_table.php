<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDadosDocumentoAddColumnsTornarObsoletoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_documento', function (Blueprint $table) {
            $table->boolean('obsoleto')->default(false);
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
            $table->dropColumn('obsoleto');
        });
    }
}
