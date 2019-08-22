<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMakeCodesUniqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formulario', function (Blueprint $table) {
            $table->unique('codigo');
        });

        Schema::table('documento', function (Blueprint $table) {
            $table->unique('codigo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formulario', function (Blueprint $table) {
            $table->dropUnique('codigo');
        });

        Schema::table('documento', function (Blueprint $table) {
            $table->dropUnique('codigo');
        });
    }
}
