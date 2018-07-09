<?php

use Illuminate\Database\Seeder;
use App\TipoSetor;

class TipoSetorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $setor       = new TipoSetor();
        $setor->nome = "Setor da Empresa";
        $setor->save();
        
        $grupoDeTreinamento       = new TipoSetor();
        $grupoDeTreinamento->nome = "Grupo de Treinamento";
        $grupoDeTreinamento->save();
        
        $grupoDeDivulgacao       = new TipoSetor();
        $grupoDeDivulgacao->nome = "Grupo de Divulgação";
        $grupoDeDivulgacao->save();

    }
}
