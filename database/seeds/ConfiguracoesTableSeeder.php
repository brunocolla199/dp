<?php

use Illuminate\Database\Seeder;
use App\Configuracao;

class ConfiguracoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codigo = new Configuracao();
        $codigo->numero_padrao_codigo = "000";
        $codigo->save();
    }
}
