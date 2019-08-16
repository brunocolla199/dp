<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterControleRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_registros', function (Blueprint $table) {
            $table->integer('local_armazenamento_id')->nullable();
            $table->foreign('local_armazenamento_id')->references('id')->on('opcoes_controle_registros');
            $table->integer('disposicao_id')->nullable();
            $table->foreign('disposicao_id')->references('id')->on('opcoes_controle_registros');
            $table->integer('meio_distribuicao_id')->nullable();
            $table->foreign('meio_distribuicao_id')->references('id')->on('opcoes_controle_registros');
            $table->integer('protecao_id')->nullable();
            $table->foreign('protecao_id')->references('id')->on('opcoes_controle_registros');
            $table->integer('recuperacao_id')->nullable();
            $table->foreign('recuperacao_id')->references('id')->on('opcoes_controle_registros');
            $table->integer('tempo_retencao_deposito_id')->nullable();
            $table->foreign('tempo_retencao_deposito_id')->references('id')->on('opcoes_controle_registros');
            $table->integer('tempo_retencao_local_id')->nullable();
            $table->foreign('tempo_retencao_local_id')->references('id')->on('opcoes_controle_registros');
            
            // Coluna que será utilizada para "excluir" o registro quando o formulário a que ele está vinculado for marcado como obsoleto
            $table->boolean('ativo')->default(true);

            // Colunas antigas que passarão a ser inúteis após esta migration ser executada...
            $table->string('meio_distribuicao')->nullable()->change();
            $table->string('local_armazenamento')->nullable()->change();
            $table->string('protecao')->nullable()->change();
            $table->string('recuperacao')->nullable()->change();
            $table->string('tempo_retencao_local')->nullable()->change();
            $table->string('tempo_retencao_deposito')->nullable()->change();
            $table->string('disposicao')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('controle_registros', function (Blueprint $table) {
            $table->dropColumn('local_armazenamento_id');
            $table->dropColumn('disposicao_id');
            $table->dropColumn('meio_distribuicao_id');
            $table->dropColumn('protecao_id');
            $table->dropColumn('recuperacao_id');
            $table->dropColumn('tempo_retencao_deposito_id');
            $table->dropColumn('tempo_retencao_local_id');
        });
    }
}
