<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Documento;

class NecessitaRevisao extends Mailable
{
    use Queueable, SerializesModels;

    public $assunto;
    public $doc;
    public $responsavelPelaAcao;
    public $tipoDocumento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($doc, User $responsavelPelaAcao, $tipo, $assunto)
    {
        $this->assunto = $assunto;
        $this->doc = $doc;
        $this->responsavelPelaAcao = $responsavelPelaAcao;
        $this->tipoDocumento = $tipo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->assunto);
        return $this->view('emails.documentos.necessita_revisao');
    }
}
