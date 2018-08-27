<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\NecessitaRevisao;

class SendEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $destinatarios;
    protected $documento;
    protected $responsavelPelaAcao;
    protected $tipo;
    protected $assunto;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($destinatarios, $documento, $responsavelPelaAcao, $tipo, $assunto)
    {
        $this->destinatarios = $destinatarios;
        $this->documento = $documento;
        $this->responsavelPelaAcao = $responsavelPelaAcao;
        $this->tipo = $tipo;
        $this->assunto = $assunto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mail $mail)
    {
        $mail::to($this->destinatarios)->send(new NecessitaRevisao($this->documento, $this->responsavelPelaAcao, $this->tipo, $this->assunto));
    }
}
