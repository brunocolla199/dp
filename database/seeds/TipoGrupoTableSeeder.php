<?php

use Illuminate\Database\Seeder;
use App\TipoGrupo;

class TipoGrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $gpTreinamento       = new TipoGrupo();
        $gpTreinamento->nome = "Treinamento";
        $gpTreinamento->save();
        
        $gpDivulgacao       = new TipoGrupo();
        $gpDivulgacao->nome = "Divulgação";
        $gpDivulgacao->save();
        
        $gpInteresse       = new TipoGrupo();
        $gpInteresse->nome = "Grupo de Interesse";
        $gpInteresse->save();

    }
}
