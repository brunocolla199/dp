<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportDocuments {type : type of documents to import [docs, forms, attachments] } {path : path to documents folder} {dest : destination folder} {--savelogs} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all the docs selected into the system  and set the relations needed.';

    /**
     * Types of documents accepted.
     *
     * @var array
     */
    protected $docsType = [
        'docs'=>['PG', 'DG', 'IT'],
        'forms'=>['Formularios'],
        'attachments'=>['Anexos']
    ];

    private $foreground_colors = array();

    
    private $background_colors = array();
    
    /**
     * Last 'setor' processed (aux value)
     * 
     * @var string
     */
    private $lastSetor = false;


    /**
     * Array with all documents not found in the database
     * 
     * @var array
     */
    private $notFound = [];

    /**
     * Folder of log files
     * 
     * @var string
     */
    private $logsDir = 'logs/';


    /**
     * Array with value to get total execution time
     * 
     * @var array
     */
    private $execTime = [];

    /**
     * Updated documents counter
     * 
     * @var int
     */
    private $updatedDocsCount = 0;

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
        $this->execTime['ini'] = microtime(true);

        $this->prepareTerminalOutput();

        $type = $this->argument('type');
        $path = $this->argument('path');
        
        echo $this->getColoredString(" \nIniciando importação de documentos '$type' localizados na pasta: '$path' ... ", "green")." \n\n";
        
        if($this->option('savelogs')){
            if(!is_writable($this->logsDir)){
                echo $this->getColoredString("Erro o diretório de logs: '$this->logsDir' não possui permissão para escrita ou não existe, resolva esse problema e rode o script novamente.", "red")." \n\n";
                exit();
            }
        }

        if(!array_key_exists($type, $this->docsType)) {
            echo $this->getColoredString(" !!! Erro: O Tipo de arquivos [$type] não é aceito pela rotina de importação, fale com o mestre {Zyad Khalil}.", "red") . "\n\n";
            exit();
        } else {
            echo $this->getColoredString("Processando documentos dentro das pastas: ".implode(',', $this->docsType[$type]), "green")." \n\n";
        }
        
        
        $this->readPath($path, true);

        echo $this->getColoredString("Novos documentos inseridos: ".count($this->notFound), "brown")." \n\n";
        echo $this->getColoredString("Documentos atualizados: ".$this->updatedDocsCount, "brown")." \n\n";
        
        $this->execTime['end'] = microtime(true);
        $this->execTime['total'] = ($this->execTime['end'] - $this->execTime['ini'])/60;
        
        echo $this->getColoredString("Tempo de execução do script: ". $this->execTime['total']." Mins", "brown")." \n\n";
        dd($this->notFound);
        
    }

    /**
     * List/prepare all files from the path
     * 
     * @param (String) $path [path to documents folder]
     */
    public function readPath($path, $checkFolder){


        if($checkFolder){
            foreach($this->docsType[$this->argument('type')] as $key => $folder){
                $dir = new \DirectoryIterator($path.$folder);
                echo $this->getColoredString(" \n ----------------- Processando documentos $folder ----------------- \n ", "yellow")." \n\n";
                foreach ($dir as $fileinfo) {
                    if (!$fileinfo->isDot()) {
                        if($fileinfo->isFile()){
                            $filename = $fileinfo->getFilename();
                            // echo $this->getColoredString(" --- Arquivo: $filename \n ", "green")." \n\n";
                            $this->getFileInfo($this->argument('type'), $filename, $fileinfo->getPathname());
                        } else {
                            $pathname = $fileinfo->getPathname();
                            $this->lastSetor = last(explode("/", $pathname)); 
                            $this->readPath($pathname, false);
                            echo $this->getColoredString(" --- Diretório: $pathname \n ", "green")." \n\n";
                        }
                    } 
                }
            }
        } else {
            
            $dir = new \DirectoryIterator($path);
            echo $this->getColoredString(" \n ----------------- Processando documentos  $this->lastSetor ----------------- \n ", "yellow")." \n\n";
            foreach ($dir as $fileinfo) {
                if (!$fileinfo->isDot()) {
                    if($fileinfo->isFile()){
                        $filename = $fileinfo->getFilename();
                        // echo $this->getColoredString(" --- Arquivo: $filename \n ", "green")." \n\n";
                        $this->getFileInfo($this->argument('type'), $filename, $fileinfo->getPathname());
                    } else {
                        $pathname = $fileinfo->getPathname();
                        $this->lastSetor = last(explode("/", $pathname)); 
                        $this->readPath($pathname, false);
                        echo $this->getColoredString(" --- Diretório: $pathname \n ", "green")." \n\n";
                    }
                } 
            }
        
        }        
    }

    /**
     * 
     * 
     */
    private function getFileInfo($type, $filename, $path){
        
        $parts = explode(" ", $filename);
        $codigo = trim($parts[0]); 
        $revisao = trim(str_replace(".doc", "", str_replace(".docx", "", explode("Rev.", $filename)[1]))); 
        $dataRevisao = $parts[count($parts)-3];
        $dataValidade =  \Carbon\Carbon::parse($this->formatDate($dataRevisao))->addYear()->format('Y-m-d');
        $setor = $this->lastSetor;
        $documentobase = $this->getDatabaseInfo($codigo);
        
        if($setor){
            $setorbase = $this->getSetorDatabaseInfo($setor);
        } else {
            $setorbase = false;
        }
        
        if($documentobase){
            if($revisao > $documentobase->revisao){
                $titulo = explode("rev", $documentobase->nome)[0]."rev".$revisao;
            } else {
                $titulo = $documentobase->nome;
            }

            $dest = $this->argument('dest')."/".$titulo.".docx";

            echo $this->getColoredString(" ------------------ Atual ------------------ ", "blue")." \n";
            echo $this->getColoredString("   |   Nome:  $documentobase->nome", "blue")." \n";
            echo $this->getColoredString("   |   Código:  $documentobase->codigo", "blue")." \n";
            echo $this->getColoredString("   |   Revisão:  $documentobase->revisao", "blue")." \n";
            echo $this->getColoredString("   |   Data Revisão:  $documentobase->updated_at ", "blue")." \n";
            echo $this->getColoredString("   |   Data Validade:  $documentobase->validade \n", "blue")." \n";
            
            echo $this->getColoredString(" ------------------ Novo ------------------ ", "green")." \n";
            echo $this->getColoredString("   |   Nome:  $titulo", "green")." \n";
            echo $this->getColoredString("   |   Código:  $codigo", "green")." \n";
            echo $this->getColoredString("   |   Revisão:  $revisao", "green")." \n";
            echo $this->getColoredString("   |   Data Revisão (updated_at): ".$this->formatDate($dataRevisao), "green")." \n";
            echo $this->getColoredString("   |   Data Validade:  $dataValidade \n", "green")." \n";
            echo $this->getColoredString("   |   Caminho :  $path ", "green")." \n";
            echo $this->getColoredString("   |   Destino :  $dest ", "green")." \n";
            echo $this->getColoredString("   |   cp $path $dest", "purple")." \n\n";

            exec("cp '$path' '$dest' ");

            $this->updateDocument($documentobase, $revisao, $this->formatDate($dataRevisao), $dataValidade, $path, $setorbase);
            $this->updatedDocsCount++;
            
        } else {
            $this->setDocumentNotFound($codigo, $filename);
            $setorID = ($setorbase) ? $setorbase->id : 1;

            $titulo = str_replace('Rev.', '_rev', $filename);
            $titulo = explode(" - ",$titulo)[1]." ".last(explode(" - ",$titulo));

            $dest = $this->argument('dest')."/".$titulo;

            echo $this->getColoredString(" ------------------ Novo (Insert) ------------------ ", "light_red")." \n";
            echo $this->getColoredString("   |   Nome:  $titulo", "light_red")." \n";
            echo $this->getColoredString("   |   Código:  $codigo", "light_red")." \n";
            echo $this->getColoredString("   |   Revisão:  $revisao", "light_red")." \n";
            echo $this->getColoredString("   |   Data Revisão (updated_at): ".$this->formatDate($dataRevisao), "light_red")." \n";
            echo $this->getColoredString("   |   Data Validade:  $dataValidade \n", "light_red")." \n";
            echo $this->getColoredString("   |   Caminho :  $path ", "light_red")." \n";
            echo $this->getColoredString("   |   Destino :  $dest ", "light_red")." \n";
            echo $this->getColoredString("   |   cp $path $dest", "purple")." \n\n";

            exec("cp '$path' '$dest' ");

            $this->insertDocument($titulo, $codigo, $revisao, $this->formatDate($dataRevisao), $dataValidade, $setorID, $path);
        }
    }

    /**
     * Update document data (db)
     * 
     */
    private function updateDocument($documento, $revisao, $dataRevisao, $dataValidade, $path, $setor){ 
    
        $doc = \App\Documento::find($documento->id);
        $doc->timestamps = false;
        $doc->updated_at = \Carbon\Carbon::createFromFormat('Y-m-d', $dataRevisao);
        $doc->save();

        $dataValidade =  \Carbon\Carbon::parse($this->formatDate($doc->updated_at))->addYear()->format('Y-m-d');

        $doc_dados = \App\DadosDocumento::where('documento_id', '=', $documento->id)->get()->first();
        $doc_dados->validade = $dataValidade;
        $doc_dados->revisao = $revisao;
        
        if($setor){
            $doc_dados->setor_id = $setor->id;
        }

        $doc_dados->save();
    }

    /**
     * Insert document data (db)
     * 
     */

    private function insertDocument($filename, $codigo, $revisao, $dataRevisao, $dataValidade, $setor, $path){

        $documento = new \App\Documento();
        $documento->timestamps = false;
        $documento->updated_at = \Carbon\Carbon::createFromFormat('Y-m-d', $dataRevisao);
        $documento->nome                = str_replace(".docx", "", $filename);
        $documento->codigo              = $codigo;
        $documento->extensao            = 'docx';
        $documento->tipo_documento_id   = $this->getTypeDoc($codigo);
        $documento->save();
        
        $dataValidade =  \Carbon\Carbon::parse($this->formatDate($documento->updated_at))->addYear()->format('Y-m-d');


        $dados_documento = new \App\DadosDocumento();
        $dados_documento->validade                          = $dataValidade;
        $dados_documento->status                            = true;
        $dados_documento->observacao                        = "Documento Finalizado (Importação - Fevereiro 2019 )";
        $dados_documento->copia_controlada                  = false;
        $dados_documento->nivel_acesso                      = 'Livre';
        $dados_documento->necessita_revisao                 = false;
        $dados_documento->id_usuario_solicitante            = null;
        $dados_documento->revisao                           = $revisao;
        $dados_documento->justificativa_rejeicao_revisao    = null;
        $dados_documento->em_revisao                        = false;
        $dados_documento->justificativa_cancelar_revisao    = null;
        $dados_documento->finalizado                        = true;
        $dados_documento->setor_id                          = $setor;
        $dados_documento->elaborador_id                     = 1;
        $dados_documento->aprovador_id                      = 1;
        $dados_documento->documento_id                      = $documento->id; // id que acabou de ser inserido no 'save' acima
        $dados_documento->save();
        
        //WorkFlow
        $workflow = new \App\Workflow();
        $workflow->etapa_num     = \App\Classes\Constants::$ETAPA_WORKFLOW_QUALIDADE_NUM;
        $workflow->etapa         = "";
        $workflow->descricao     = "Documento Importado Rotina Speed";
        $workflow->justificativa = "";
        $workflow->documento_id = $documento->id; // id que acabou de ser inserido no 'save' na tabela de documento
        $workflow->save();

        //Historico
        \App\Classes\Helpers::instance()->gravaHistoricoDocumento("Documento Importado", $documento->id);

    }

    /**
     * Get document type id
     * 
     * @param int $cod  
     * 
     */
    private function getTypeDoc($cod){
        if (strpos($cod, 'PG-') !== false) {
            return 2;
        } else if(strpos($cod, 'IT-') !== false) {
            return 1;
        } else if(strpos($cod, 'DG-') !== false) {
            return 3;
        } else if(strpos($cod, 'FR-') !== false) {
            return 4;
        }
    }

    /**
     * 
     * 
     */
    private function getSetorDatabaseInfo($setor){
        return \App\Setor::where('sigla', '=', $setor)->get()->first();
    }

    /**
     * 
     * 
     */
    private function getDatabaseInfo($codigo){
        return $documento = \App\Documento::join('dados_documento','dados_documento.documento_id', '=', 'documento.id')->where('codigo', $codigo)->get()->first();
    }


    private function setDocumentNotFound($codigo, $nome){
        array_push($this->notFound, array('nome'=>$nome, 'codigo'=> $codigo)); 
    }

    /**
     * 
     * 
     */
    private function formatDate($dt){
        return implode("-", array_reverse(explode(".", $dt)));
    }

    // Extra function's (Terminal Colors)

    /**
     * Set logs from import routine
     * @param $msg (Mensagem do log), $tp (Tipo do log)
     * @param $tp (Tipo do log)
     * @return array
     */
    function setlog($msg, $tp){
        
        if($tp == 'erro'){
            $log_file_name = date('d-m-y')."_log_error.txt";
            $fp = fopen($this->logsDir.$log_file_name, 'a');
            fwrite($fp, PHP_EOL.date('d-m-y H:i:s')." | ".$msg);
            fclose($fp);
        } else if($tp == 'success'){
            $log_file_name = date('d-m-y')."_log_success.txt";
            //dd($this->logsDir.$log_file_name);
            $fp = fopen($this->logsDir.$log_file_name, 'a');
            fwrite($fp, PHP_EOL.date('d-m-y H:i:s')." | ".$msg);
            fclose($fp);
        } else if($tp == 'time'){
            $log_file_name = date('d-m-y')."_log_time.txt";
            $fp = fopen($this->logsDir.$log_file_name, 'a');
            fwrite($fp, PHP_EOL.date('d-m-y H:i:s')." | ".$msg);
            fclose($fp);
        }
    }


    private function prepareTerminalOutput(){
        // Set up shell colors
        $this->foreground_colors['black'] = '0;30';
        $this->foreground_colors['dark_gray'] = '1;30';
        $this->foreground_colors['blue'] = '0;34';
        $this->foreground_colors['light_blue'] = '1;34';
        $this->foreground_colors['green'] = '0;32';
        $this->foreground_colors['light_green'] = '1;32';
        $this->foreground_colors['cyan'] = '0;36';
        $this->foreground_colors['light_cyan'] = '1;36';
        $this->foreground_colors['red'] = '0;31';
        $this->foreground_colors['light_red'] = '1;31';
        $this->foreground_colors['purple'] = '0;35';
        $this->foreground_colors['light_purple'] = '1;35';
        $this->foreground_colors['brown'] = '0;33';
        $this->foreground_colors['yellow'] = '1;33';
        $this->foreground_colors['light_gray'] = '0;37';
        $this->foreground_colors['white'] = '1;37';

        $this->background_colors['black'] = '40';
        $this->background_colors['red'] = '41';
        $this->background_colors['green'] = '42';
        $this->background_colors['yellow'] = '43';
        $this->background_colors['blue'] = '44';
        $this->background_colors['magenta'] = '45';
        $this->background_colors['cyan'] = '46';
        $this->background_colors['light_gray'] = '47';
    }

    // Returns colored string
    public function getColoredString($string, $foreground_color = null, $background_color = null) {
        $colored_string = "";
        // Check if given foreground color found
        if (isset($this->foreground_colors[$foreground_color])) {
            $colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
        }
        // Check if given background color found
        if (isset($this->background_colors[$background_color])) {
            $colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
        }

        // Add string and end coloring
        $colored_string .=  $string . "\033[0m";
        
        if($this->option('savelogs') && is_writable($this->logsDir)){
            $this->setlog($string, "success");
        }

        return $colored_string;
    }

    // Returns all foreground color names
    public function getForegroundColors() {
        return array_keys($this->foreground_colors);
    }

    // Returns all background color names
    public function getBackgroundColors() {
        return array_keys($this->background_colors);
    }

}
