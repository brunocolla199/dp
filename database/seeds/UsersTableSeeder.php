<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Qualidade
        $qualidade           = new User();
        $qualidade->name     = "Qualidade";
        $qualidade->username = "qualidade";
        $qualidade->email    = "qualidade@speedsoftware.com.br";
        $qualidade->setor_id = 1;
        $qualidade->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $qualidade->save();

        // Diretores
        $diretor1           = new User();
        $diretor1->name     = "Usuário Diretor I";
        $diretor1->username = "diretor1";
        $diretor1->email    = "diretor1@speedsoftware.com.br";
        $diretor1->setor_id = 2;
        $diretor1->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $diretor1->save();

        $diretor2           = new User();
        $diretor2->name     = "Usuário Diretor II";
        $diretor2->username = "diretor2";
        $diretor2->email    = "diretor2@speedsoftware.com.br";
        $diretor2->setor_id = 2;
        $diretor2->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $diretor2->save();

        // Gerentes
        $gerente1           = new User();
        $gerente1->name     = "Usuário Gerência I";
        $gerente1->username = "gerente1";
        $gerente1->email    = "gerente1@speedsoftware.com.br";
        $gerente1->setor_id = 3;
        $gerente1->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $gerente1->save();

        $gerente2           = new User();
        $gerente2->name     = "Usuário Gerência II";
        $gerente2->username = "gerente2";
        $gerente2->email    = "gerente2@speedsoftware.com.br";
        $gerente2->setor_id = 3;
        $gerente2->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $gerente2->save();
                
    }
}
