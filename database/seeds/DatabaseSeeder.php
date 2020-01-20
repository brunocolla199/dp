<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TipoSetorTableSeeder::class);
        $this->call(SetorTableSeeder::class);
        $this->call(TipoDocumentoTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ConfiguracoesTableSeeder::class);
        $this->call(FormularioRevisaoTableSeeder::class);
    }
}
