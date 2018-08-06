<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHistoricoFormularioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historico_formulario', function (Blueprint $table) {
            $table->integer('id_usuario_responsavel')->nullable()->after('descricao');
            $table->string('nome_usuario_responsavel', 80)->nullable()->after('id_usuario_responsavel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historico_formulario', function (Blueprint $table) {
            $table->dropColumn('id_usuario_responsavel');
            $table->dropColumn('nome_usuario_responsavel');
        });
    }
}
