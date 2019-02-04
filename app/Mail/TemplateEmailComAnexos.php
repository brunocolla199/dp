<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TemplateEmailComAnexos extends Mailable
{
    use Queueable, SerializesModels;

    public $assunto;

    // Ícone
    public $icon;

    // Frase 1
    public $contentF1_P1;
    public $codeF1;
    public $contentF1_P2;

    // Frase 2
    public $labelF2;
    public $valueF2;

    // Frase 3
    public $labelF3;
    public $valueF3;
    public $label2_F3;
    public $value2_F3;

    // Anexo
    public $pathAnexo;
    public $nomeAnexo;
    public $mimeTypeAnexo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($assunto, $icon, $contentF1_P1, $codeF1, $contentF1_P2, $labelF2, $valueF2, $labelF3, $valueF3, $label2_F3, $value2_F3, $pathAnexo, $nomeAnexo, $mimeTypeAnexo)
    {
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->assunto);

        return $this->view('emails.template_email')
                ->attach($this->pathAnexo, [
                    'as' => $this->nomeAnexo,
                    'mime' => $this->mimeTypeAnexo,
                ]);
                
    }
}
