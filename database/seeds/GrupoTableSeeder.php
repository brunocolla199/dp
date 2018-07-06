<?php

use Illuminate\Database\Seeder;
use App\Grupo;

class GrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $gp1                = new Grupo();
        $gp1->nome          = "Grupo 1 - Treinamento";
        $gp1->descricao     = "Este é o exemplo 1 para os grupos - treinamento";
        $gp1->tipo_grupo_id = 1;
        $gp1->save();
        
        $gp2                = new Grupo();
        $gp2->nome          = "Grupo 2 - Divulgação";
        $gp2->descricao     = "Este é o exemplo 2 para os grupos - divulgação";
        $gp2->tipo_grupo_id = 2;
        $gp2->save();
        
        $gp3                = new Grupo();
        $gp3->nome          = "Grupo 3 - Interesse";
        $gp3->descricao     = "Este é o exemplo 3 para os grupos - interesse";
        $gp3->tipo_grupo_id = 3;
        $gp3->save();

    }
}
