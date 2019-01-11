<?php

use Illuminate\Database\Seeder;
use App\Configuracao;
use App\User;
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
        // Instrução de Trabalho
        $codigo = new Configuracao();
        $codigo->numero_padrao_codigo = "000";
        $codigo->admin_setor_qualidade = 0;
        $codigo->save();


        /** Usuário administrador do setor da Qualidade */
        $user = User::where('username', '=', 'speedsoft')->get();
        $idAdmin = ( count($user) > 0 && $user[0] != null) ? $user[0]->id : Constants::$ID_USUARIO_ADMIN_SETOR_QUALIDADE;

        $codigo2 = new Configuracao();
        $codigo2->numero_padrao_codigo = "";
        $codigo2->admin_setor_qualidade = $idAdmin;
        $codigo2->save();

        
        // INSERT INTO configuracao (numero_padrao_codigo, admin_setor_qualidade, created_at, updated_at) VALUES ('00', 0, '2019-01-10 16:00:00', '2019-01-10 16:00:00');
        // Diretrizes de Gestão
        $codigoDG = new Configuracao();
        $codigoDG->numero_padrao_codigo = "00";
        $codigoDG->admin_setor_qualidade = 0;
        $codigoDG->save();
        
        // Procedimentos de Gestão
        $codigoPG = new Configuracao();
        $codigoPG->numero_padrao_codigo = "00";
        $codigoPG->admin_setor_qualidade = 0;
        $codigoPG->save();
    }
}
