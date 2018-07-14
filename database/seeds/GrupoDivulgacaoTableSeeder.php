<?php

use Illuminate\Database\Seeder;
use App\GrupoDivulgacao;

class GrupoDivulgacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $g1 = new GrupoDivulgacao();
        $g1->nome       = "Exemplo Divulgação I";
        $g1->descricao  = "O primeiro exemplo de grupo de divulgação para demonstrar a forma como os usuário serão atribuídos a vários grupos diferentes.";
        $g1->save();
        
        $g2 = new GrupoDivulgacao();
        $g2->nome       = "Exemplo Divulgação II";
        $g2->descricao  = "O segundo exemplo de grupo de divulgação para demonstrar a forma como os usuário serão atribuídos a vários grupos diferentes.";
        $g2->save();

    }
}
