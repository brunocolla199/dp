<?php

namespace App\Console\Commands;

use App\DocumentoFormulario;
use App\Formulario;
use App\FormularioRevisao;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateFakeRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:records  
                            {code : the form code that will be imported}
                            {--obsolete : defines whether obsolete forms should be considered}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates "fake" records to temporarily solve the problem of canceling the first form revisions.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $code = explode('=', $this->argument('code'))[1];
        // TODO: aqui daria para verificar se o usuário mandou 'all' como parâmetro, por exemplo, e então buscar todos os formulários que não tem revisão salva e, automaticamente, criar uma para cada um.
        $obsolete = (!empty($this->option('obsolete'))) ? true : false;

        $qtdForms = Formulario::where('codigo', $code)->where('obsoleto', $obsolete)->count();
        if ($qtdForms != 1) {
            $this->warn("-- Encontramos {$qtdForms} formulários com esse código. Sugiro que você revise seu comando ou verifique se isso está correto.");
            return;
        }

        $form = Formulario::where("codigo", $code)->first();
        $qtdReviews = FormularioRevisao::where("formulario_id", $form->id)->count();
        if ($qtdReviews > 0) {
            if (!$this->confirm("Esse formulário já possui {$qtdReviews} revisões salvas. Você deseja mesmo criar mais um que seja o 'backup' do estado atual?")) {
                return;
            }
        }

        $this->createFakeRecord($form);
        $this->info("-- Finalizado. --");
    }


    public function createFakeRecord(Formulario $_form)
    {
        $formRevisao = new FormularioRevisao();
        $formRevisao->codigo = $_form->codigo;
        $formRevisao->revisao = $_form->revisao;
        $formRevisao->nome = $_form->nome;
        $formRevisao->nome_completo = $_form->nome . "." . $_form->extensao;
        $formRevisao->extensao = $_form->extensao;
        $formRevisao->nivel_acesso = $_form->nivel_acesso;
        $formRevisao->finalizado = true;
        
        $documentosNecessitam = DocumentoFormulario::where(
            'formulario_id',
            '=',
            $_form->id
        )->get()->pluck('documento_id');

        $documentosNecessitam_TXT = null;
        foreach ($documentosNecessitam as $key => $value) {
            if (is_null($documentosNecessitam_TXT)) {
                $documentosNecessitam_TXT = $value;
            } else {
                $documentosNecessitam_TXT .= ";" . $value;
            }
        }
        
        $formRevisao->documentos_necessitam = $documentosNecessitam_TXT;
        $formRevisao->formulario_id = $_form->id;
        $formRevisao->tipo_documento_id = $_form->tipo_documento_id;
        $formRevisao->elaborador_id = $_form->elaborador_id;
        $formRevisao->setor_id = $_form->setor_id;
        $formRevisao->save();
    }
}
