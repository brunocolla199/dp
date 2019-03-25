<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\TemplateEmailComAnexos;

class SendEmailComAnexoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Propriedades do envio
    protected $destinatarios;
    protected $assunto;
    
    // Ícone
    protected $icon;

    // Frase 1
    protected $contentF1_P1;
    protected $codeF1;
    protected $contentF1_P2;

    // Frase 2
    protected $labelF2;
    protected $valueF2;

    // Frase 3
    protected $labelF3;
    protected $valueF3;
    protected $label2_F3;
    protected $value2_F3;

    // Anexo
    public $pathAnexo;
    public $nomeAnexo;
    public $mimeTypeAnexo;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($destinatarios, $assunto, $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3, $pathAnexo, $nomeAnexo, $mimeTypeAnexo)
    {
        $this->destinatarios = $destinatarios;
        $this->assunto = $assunto;

        $this->icon = $icon;

        $this->contentF1_P1 = $contentF1_P1;
        $this->codeF1 = $codeF1;
        $this->contentF1_P2 = $contentF1_P2;

        $this->labelF2 = $labelF2;
        $this->valueF2 = $valueF2;

        $this->labelF3 = $labelF3;
        $this->valueF3 = $valueF3;
        $this->label2_F3 = $label2_F3;
        $this->value2_F3 = $value2_F3;

        $this->pathAnexo     = $pathAnexo;
        $this->nomeAnexo     = $nomeAnexo;
        $this->mimeTypeAnexo = $mimeTypeAnexo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mail $mail)
    {
        $mail::to($this->destinatarios)->send(new TemplateEmailComAnexos($this->assunto,   $this->icon, $this->contentF1_P1, $this->codeF1, $this->contentF1_P2, $this->labelF2, $this->valueF2, $this->labelF3, $this->valueF3, $this->label2_F3, $this->value2_F3, $this->pathAnexo, $this->nomeAnexo, $this->mimeTypeAnexo));
    }
}