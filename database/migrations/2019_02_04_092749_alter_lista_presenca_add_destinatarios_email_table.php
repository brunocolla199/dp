<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterListaPresencaAddDestinatariosEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lista_presenca', function (Blueprint $table) {
            $table->text('destinatarios_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lista_presenca', function (Blueprint $table) {
            $table->dropColumn('destinatarios_email');
        });
    }
}
