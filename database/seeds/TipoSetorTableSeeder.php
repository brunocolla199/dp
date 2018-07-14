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
        
        $diretoria       = new TipoSetor();
        $diretoria->nome = "Diretoria";
        $diretoria->save();
        
        $gerencia       = new TipoSetor();
        $gerencia->nome = "Gerência";
        $gerencia->save();

    }
}
