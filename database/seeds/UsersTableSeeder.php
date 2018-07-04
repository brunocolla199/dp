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
        
        $admSpeed           = new User();
        $admSpeed->name     = "Administrador Speed";
        $admSpeed->username = "admin.speed";
        $admSpeed->email    = "admin.speed@gmail.com";
        $admSpeed->setor_id = 1;
        $admSpeed->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $admSpeed->save();


    }
}
