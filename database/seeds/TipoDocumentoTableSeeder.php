<?php

use Illuminate\Database\Seeder;
use App\TipoDocumento;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tp_doc1        = new TipoDocumento();
        $tp_doc1->nome_tipo  = "Instrução de Trabalho";
        $tp_doc1->sigla = "IT";
        $tp_doc1->save();
        
        $tp_doc2        = new TipoDocumento();
        $tp_doc2->nome_tipo  = "Procedimentos de Gestão";
        $tp_doc2->sigla = "PG";
        $tp_doc2->save();
        
        $tp_doc3        = new TipoDocumento();
        $tp_doc3->nome_tipo  = "Diretrizes de Gestão";
        $tp_doc3->sigla = "DG";
        $tp_doc3->save();
        
        $tp_doc4        = new TipoDocumento();
        $tp_doc4->nome_tipo  = "Formulários";
        $tp_doc4->sigla = "FR";
        $tp_doc4->save();
    }
}
