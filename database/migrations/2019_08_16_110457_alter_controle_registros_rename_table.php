<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterControleRegistrosRenameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controle_registros', function (Blueprint $table) {
            
            // Passando as colunas que estavam como nullable para unsigned int (precisaram ser nulas para que os scripts de inserção funcionassem)
            $table->integer('local_armazenamento_id')->nullable(false)->change();
            $table->integer('disposicao_id')->nullable(false)->change();
            $table->integer('meio_distribuicao_id')->nullable(false)->change();
            $table->integer('protecao_id')->nullable(false)->change();
            $table->integer('recuperacao_id')->nullable(false)->change();
            $table->integer('tempo_retencao_deposito_id')->nullable(false)->change();
            $table->integer('tempo_retencao_local_id')->nullable(false)->change();

            // Renomeando as colunas utilizadas antigamente (inúteis depois dessa atualização)
            $table->renameColumn('meio_distribuicao', 'meio_distribuicao_old');
            $table->renameColumn('local_armazenamento', 'local_armazenamento_old');
            $table->renameColumn('protecao', 'protecao_old');
            $table->renameColumn('recuperacao', 'recuperacao_old');
            $table->renameColumn('tempo_retencao_local', 'tempo_retencao_local_old');
            $table->renameColumn('tempo_retencao_deposito', 'tempo_retencao_deposito_old');
            $table->renameColumn('disposicao', 'disposicao_old');

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
            $table->dropColumn('meio_distribuicao_old');
            $table->dropColumn('local_armazenamento_old');
            $table->dropColumn('protecao_old');
            $table->dropColumn('recuperacao_old');
            $table->dropColumn('tempo_retencao_local_old');
            $table->dropColumn('tempo_retencao_deposito_old');
            $table->dropColumn('disposicao_old');
        });
    }
}
