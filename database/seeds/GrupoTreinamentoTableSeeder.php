<?php

use Illuminate\Database\Seeder;
use App\GrupoTreinamento;

class GrupoTreinamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $g1 = new GrupoTreinamento();
        $g1->nome       = "Exemplo Treinamento I";
        $g1->descricao  = "O primeiro exemplo de grupo de treinamento para demonstrar a forma como os usuário serão atribuídos a vários grupos diferentes.";
        $g1->save();
        
        $g2 = new GrupoTreinamento();
        $g2->nome       = "Exemplo Treinamento II";
        $g2->descricao  = "O segundo exemplo de grupo de treinamento para demonstrar a forma como os usuário serão atribuídos a vários grupos diferentes.";
        $g2->save();

    }
}
