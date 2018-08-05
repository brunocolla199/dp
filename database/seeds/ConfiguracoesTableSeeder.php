<?php

use Illuminate\Database\Seeder;
use App\Configuracao;
use App\Classes\Constants;

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
        $codigo->admin_setor_qualidade = 0;
        $codigo->save();

        $codigo2 = new Configuracao();
        $codigo2->numero_padrao_codigo = "";
        $codigo2->admin_setor_qualidade = Constants::$ID_USUARIO_ADMIN_SETOR_QUALIDADE;
        $codigo2->save();
    }
}
