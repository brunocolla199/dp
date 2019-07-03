<?php

namespace App\Console;

use App\Classes\Constants;
use App\{TipoSetor, User};
use Carbon\Carbon;
use App\Jobs\SendEmailsJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        /**
        *  Procura todos os documentos que vencem no dia exato resultante da operação "hoje + um mês" do Carbon. Quando encontra, seleciona todos os usuários que tem permissão de elaborador e pertencem ao setor para o qual o documento foi criado.
        *  Após encontrar todos esses usuários, salva uma notificação para cada um deles.
        */
        $schedule->call(function () {
            $PATH = storage_path('logs');
            $FILE = 'schedule_expired_documents.log';
            file_put_contents($PATH.'/'.$FILE, "### WEE_LOG ### Chamou o método para executar a tarefa de verificação de documentos vencidos agora: ". now().PHP_EOL , FILE_APPEND | LOCK_EX);

            Log::debug("### WEE_LOG ### Chamou o método para executar a tarefa de verificação de documentos vencidos agora: ". now());

            $hojeMaisUmMes = Carbon::now()->addMonth()->format('Y-m-d');
            $documentosParaVencer = DB::table('documento')->join('dados_documento', 'documento_id', '=', 'documento.id')->join('tipo_documento', 'tipo_documento.id', '=', 'documento.tipo_documento_id' )
                                        ->where('dados_documento.validade', '=', $hojeMaisUmMes)->where('dados_documento.finalizado', '=', true)
                                        ->select('documento.id', 'documento.codigo', 'documento.nome', 'dados_documento.validade', 'dados_documento.finalizado', 'dados_documento.setor_id', 'tipo_documento.nome_tipo')->get();
            
            
            foreach ($documentosParaVencer as $key => $doc) {
                $usuariosDoSetorComPermissaoElaborador = User::where('setor_id', '=', $doc->setor_id)->where('permissao_elaborador', '=', true)
                                                            ->orWhere('setor_id', '=', Constants::$ID_SETOR_QUALIDADE)->select('id', 'name', 'username', 'email', 'setor_id', 'permissao_elaborador')->get();

                // [E-mail -> (O documento irá vencer em 30 dias)]
                $icon = "info";
                $contentF1_P1 = "O documento "; $codeF1 = $doc->codigo; $contentF1_P2 = " vai vencer em 30 dias.";
                $labelF2 = "Tipo do Documento: "; $valueF2 = $doc->nome_tipo;
                $labelF3 = "Título do Documento: "; $valueF3 = explode(Constants::$SUFIXO_REVISAO_NOS_TITULO_DOCUMENTOS, $doc->nome)[0]; $label2_F3 = ""; $value2_F3 = "";

                foreach ($usuariosDoSetorComPermissaoElaborador as $key => $user) {
                    dispatch(new SendEmailsJob($user, "Validade do documento " . $doc->codigo . " expira em um mês",     $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3));
                    \App\Classes\Helpers::instance()->gravaNotificacao("O documento " . $doc->codigo . " vence em um mês ($user->email).", true, $user->id, $doc->id);    
                }
            }
        })
        ->dailyAt('06:00');
        // ->twiceDaily(6, 12); // Run the task daily at 6:00 & 12:00
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
