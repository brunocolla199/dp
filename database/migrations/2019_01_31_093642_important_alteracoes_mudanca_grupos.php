<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// Deprecated
use App\GrupoDivulgacao;
use App\GrupoDivulgacaoUsuario;
use App\GrupoTreinamento;
use App\GrupoTreinamentoUsuario;

// Active
use App\Formulario;
use App\GrupoDivulgacaoFormulario;

use App\Documento;
use App\GrupoDivulgacaoDocumento;
use App\GrupoTreinamentoDocumento;

// Utils
use Illuminate\Support\Facades\Storage;

class ImportantAlteracoesMudancaGrupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Arquivo ficará em: storage/app/
        $NOME_ARQUIVO = "LOGS_MUDANCA_GRUPOS_DP.txt";
        Storage::disk('local')->put($NOME_ARQUIVO, \Carbon\Carbon::now());


        
        /**
         * GRUPOS DE DIVULGAÇÃO     <=>     FORMULÁRIOS
         * Importa todos usuários de grupos de divulgação que haviam sido vinculados com {formulários}
         * Em seguida, remove a FK das tabelas referentes aos {formulários} e as renomeia, para lembrar facilmente que estão em desuso
         */
        Storage::disk('local')->append($NOME_ARQUIVO, PHP_EOL . PHP_EOL . PHP_EOL. PHP_EOL .  '############### Iniciando a migração ###############');
        Storage::disk('local')->append($NOME_ARQUIVO, 'GRUPOS DE DIVULGAÇÃO     <=>     FORMULÁRIOS' . PHP_EOL . PHP_EOL . PHP_EOL. PHP_EOL);

        $formularios = Formulario::all();
        foreach ($formularios as $key => $value) {
            
            $gDivulg = GrupoDivulgacao::find($value->grupo_divulgacao_id);
            Storage::disk('local')->append($NOME_ARQUIVO, "=> Grupo Divulgação atual: [$gDivulg->nome] / Formulário: $value->nome  ($value->id)  ");
            
            $usersGD   = GrupoDivulgacaoUsuario::where('grupo_id', '=', $gDivulg->id)->select('usuario_id')->get();
            $str = implode("; ", array_flatten($usersGD->toArray()));
            Storage::disk('local')->append($NOME_ARQUIVO, "=> ID dos usuários do grupo [$value->grupo_divulgacao_id]:  " . $str . PHP_EOL );
            foreach ($usersGD as $key2 => $userGD) {
                
                $newReg = new GrupoDivulgacaoFormulario();
                $newReg->formulario_id  = $value->id;
                $newReg->usuario_id     = $userGD->usuario_id;
                $newReg->save();
            }
        }
        
        Schema::table('formulario', function (Blueprint $table) {
            $table->dropForeign('formulario_grupo_divulgacao_id_foreign');
            $table->integer('grupo_divulgacao_id')->nullable()->change();
            $table->renameColumn('grupo_divulgacao_id', 'OLD_grupo_divulgacao_id');
        });
        
        
        Schema::table('formulario_revisao', function (Blueprint $table) {
            $table->dropForeign('formulario_revisao_grupo_divulgacao_id_foreign');
            $table->integer('grupo_divulgacao_id')->nullable()->change();
            $table->renameColumn('grupo_divulgacao_id', 'OLD_grupo_divulgacao_id');
        });

        


        
        /**
         * GRUPOS DE DIVULGAÇÃO     <=>     DOCUMENTOS
         * Importa todos usuários de grupos de divulgação que haviam sido vinculados com {documentos}
         * Em seguida, remove a FK das tabelas referentes aos {documentos} e as renomeia, para lembrar facilmente que estão em desuso
         */
        Storage::disk('local')->append($NOME_ARQUIVO, PHP_EOL . PHP_EOL . PHP_EOL. PHP_EOL .  '############### Iniciando a migração ###############');
        Storage::disk('local')->append($NOME_ARQUIVO, 'GRUPOS DE DIVULGAÇÃO     <=>     DOCUMENTOS' . PHP_EOL . PHP_EOL . PHP_EOL. PHP_EOL);

        $documentos = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')->select('documento.id', 'documento.nome', 'dados_documento.grupo_divulgacao_id')->get();
        foreach ($documentos as $key => $value) {
            
            $gDivulg = GrupoDivulgacao::find($value->grupo_divulgacao_id);
            Storage::disk('local')->append($NOME_ARQUIVO, "=> Grupo Divulgação atual: [$gDivulg->nome] / Documento: $value->nome  ($value->id)  ");

            $usersGD   = GrupoDivulgacaoUsuario::where('grupo_id', '=', $gDivulg->id)->select('usuario_id')->get();
            $str = implode("; ", array_flatten($usersGD->toArray()));
            Storage::disk('local')->append($NOME_ARQUIVO, "=> ID dos usuários do grupo [$value->grupo_divulgacao_id]:  " . $str . PHP_EOL );
            foreach ($usersGD as $key2 => $userGD) {
                
                $newReg = new GrupoDivulgacaoDocumento();
                $newReg->documento_id  = $value->id;
                $newReg->usuario_id    = $userGD->usuario_id;
                $newReg->save();
            }
        }
        
        Schema::table('dados_documento', function (Blueprint $table) {
            $table->dropForeign('dados_documento_grupo_divulgacao_id_foreign');
            $table->integer('grupo_divulgacao_id')->nullable()->change();
            $table->renameColumn('grupo_divulgacao_id', 'OLD_grupo_divulgacao_id');
        });

        


        
        /**
         * GRUPOS DE TREINAMENTO     <=>     DOCUMENTOS
         * Importa todos usuários de grupos de treinamento que haviam sido vinculados com {documentos}
         * Em seguida, remove a FK das tabelas referentes aos {documentos} e as renomeia, para lembrar facilmente que estão em desuso
         */
        Storage::disk('local')->append($NOME_ARQUIVO, PHP_EOL . PHP_EOL . PHP_EOL. PHP_EOL .  '############### Iniciando a migração ###############');
        Storage::disk('local')->append($NOME_ARQUIVO, 'GRUPOS DE TREINAMENTO     <=>     DOCUMENTOS' . PHP_EOL . PHP_EOL . PHP_EOL. PHP_EOL);

        $documentos = Documento::join('dados_documento', 'dados_documento.documento_id', '=', 'documento.id')->select('documento.id', 'documento.nome', 'dados_documento.grupo_treinamento_id')->get();
        foreach ($documentos as $key => $value) {
            
            $gTrein = GrupoTreinamento::find($value->grupo_treinamento_id);
            Storage::disk('local')->append($NOME_ARQUIVO, "=> Grupo Treinamento atual: [$gTrein->nome] / Documento: $value->nome  ($value->id)  ");

            $usersGD   = GrupoTreinamentoUsuario::where('grupo_id', '=', $gTrein->id)->select('usuario_id')->get();
            $str = implode("; ", array_flatten($usersGD->toArray()));
            Storage::disk('local')->append($NOME_ARQUIVO, "=> ID dos usuários do grupo [$value->grupo_treinamento_id]:  " . $str . PHP_EOL );
            foreach ($usersGD as $key2 => $userGD) {
                
                $newReg = new GrupoTreinamentoDocumento();
                $newReg->documento_id  = $value->id;
                $newReg->usuario_id    = $userGD->usuario_id;
                $newReg->save();
            }
        }
        
        Schema::table('dados_documento', function (Blueprint $table) {
            $table->dropForeign('dados_documento_grupo_treinamento_id_foreign');
            $table->integer('grupo_treinamento_id')->nullable()->change();
            $table->renameColumn('grupo_treinamento_id', 'OLD_grupo_treinamento_id');
        });

        
        

        
        
        
        /**
         * Após migrar todos os dados, renomeio as tabelas que cairão em desuso a partir de agora
         */
        Schema::rename('grupo_divulgacao',          'old_grupo_divulgacao');
        Schema::rename('grupo_divulgacao_usuario',  'old_grupo_divulgacao_usuario');
        Schema::rename('grupo_treinamento',         'old_grupo_treinamento');
        Schema::rename('grupo_treinamento_usuario', 'old_grupo_treinamento_usuario');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('important_alteracoes_mudanca_grupos');
    }
}
