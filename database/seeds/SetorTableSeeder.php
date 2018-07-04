<?php

use Illuminate\Database\Seeder;
use App\Setor;

class SetorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $qualidade               = new Setor();
        $qualidade->nome         = "Qualidade";
        $qualidade->descricao    = "Waiting description...";
        $qualidade->save();
        
        $financeiro              = new Setor();
        $financeiro->nome        = "Financeiro";
        $financeiro->descricao   = "Waiting description...";
        $financeiro->save();
        
        $rh                      = new Setor();
        $rh->nome                = "Recursos Humanos";
        $rh->descricao           = "Waiting description...";
        $rh->save();

    }
}
