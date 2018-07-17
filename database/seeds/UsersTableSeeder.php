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

        $qualidade2           = new User();
        $qualidade2->name     = "Celise Zilli";
        $qualidade2->username = "celise.zilli";
        $qualidade2->email    = "celise.zilli@dpworld.com";
        $qualidade2->setor_id = 1;
        $qualidade2->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $qualidade2->save();

        $qualidade3           = new User();
        $qualidade3->name     = "Natalia Hoyer";
        $qualidade3->username = "natalia.hoyer";
        $qualidade3->email    = "natalia.hoyer@dpworld.com";
        $qualidade3->setor_id = 1;
        $qualidade3->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $qualidade3->save();

        $qualidade4           = new User();
        $qualidade4->name     = "Jéssica Magalhães";
        $qualidade4->username = "jessica.magalhaes";
        $qualidade4->email    = "jessica.magalhaes@dpworld.com";
        $qualidade4->setor_id = 1;
        $qualidade4->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $qualidade4->save();


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
        




        /*
        * SETORES NORMAIS ABAIXO
        */
        
        // Administrativo
        $administrativo1           = new User();
        $administrativo1->name     = "Usuário Administrativo I";
        $administrativo1->username = "administrativo1";
        $administrativo1->email    = "administrativo1@speedsoftware.com.br";
        $administrativo1->setor_id = 4;
        $administrativo1->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $administrativo1->save();
        
        // Armadores
        $armadores1           = new User();
        $armadores1->name     = "Usuário Armadores I";
        $armadores1->username = "armadores1";
        $armadores1->email    = "armadores1@speedsoftware.com.br";
        $armadores1->setor_id = 5;
        $armadores1->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $armadores1->save();
        
        // CDI
        $cdi1           = new User();
        $cdi1->name     = "Usuário CDI I";
        $cdi1->username = "cdi1";
        $cdi1->email    = "cdi1@speedsoftware.com.br";
        $cdi1->setor_id = 6;
        $cdi1->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $cdi1->save();
        
        // Compras
        $compras1           = new User();
        $compras1->name     = "Usuário Compras I";
        $compras1->username = "compras1";
        $compras1->email    = "compras1@speedsoftware.com.br";
        $compras1->setor_id = 7;
        $compras1->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $compras1->save();
        
        // Comercial
        $comercial1           = new User();
        $comercial1->name     = "Usuário Comercial I";
        $comercial1->username = "comercial1";
        $comercial1->email    = "comercial1@speedsoftware.com.br";
        $comercial1->setor_id = 8;
        $comercial1->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $comercial1->save();

        $comercial2           = new User();
        $comercial2->name     = "Usuário Comercial II";
        $comercial2->username = "comercial2";
        $comercial2->email    = "comercial2@speedsoftware.com.br";
        $comercial2->setor_id = 8;
        $comercial2->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $comercial2->save();

                
    }
}
