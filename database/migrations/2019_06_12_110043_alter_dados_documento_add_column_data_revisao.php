<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\{DadosDocumento, Documento, HistoricoDocumento};
use Illuminate\Support\Facades\Log;

class AlterDadosDocumentoAddColumnDataRevisao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dados_documento', function (Blueprint $table) {
            $table->timestamp('data_revisao')->nullable();
        });

        
        $documentos = DadosDocumento::join('documento', 'documento.id', '=', 'dados_documento.documento_id')->select('documento.id', 'documento.codigo', 'dados_documento.id AS dd_id')->orderBy('id')->get();
        foreach ($documentos as $key => $doc) {
            Log::debug("### WEE_LOG ### O documento $doc->codigo [id = $doc->id] :");
            $historico = HistoricoDocumento::where('documento_id', $doc->id)->where('descricao', Constants::$DESCRICAO_WORKFLOW_DOCUMENTO_DIVULGADO)->orderBy('id', 'desc')->first();
            if( !is_null($historico) )   {
                Log::debug("### WEE_LOG ### Possui histórico de documento divulgado! [hId = $historico->id] \n\n");
                
                $doc->data_revisao = $historico->created_at;
            } else {
                $historico = HistoricoDocumento::where('documento_id', $doc->id)->where('descricao', 'Documento Importado')->orderBy('id', 'desc')->first();
                if( !is_null($historico) ) {
                    Log::debug("### WEE_LOG ### NÃO Possui histórico de documento divulgado, mas possui de documento importado! [hId = $historico->id] \n\n");
                    $doc->data_revisao = $historico->created_at;
                } else {
                    $historico = HistoricoDocumento::where('documento_id', $doc->id)->orderBy('id', 'desc')->first();
                    Log::debug("### WEE_LOG ### NÃO Possui histórico de documento divulgado, NÃO possui de documento importado, por isso peguei o último! [hId = $historico->id] \n\n");
                    $doc->data_revisao = $historico->created_at;
                }
            }
            $doc->save();
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipos', function (Blueprint $table) {
            $table->dropColumn('data_revisao');
        });
    }
}
