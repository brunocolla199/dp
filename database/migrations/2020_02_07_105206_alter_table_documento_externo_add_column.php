<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDocumentoExternoAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documento_externo', function (Blueprint $table) {
            $table->integer('fornecedor_id')->nullable(true)->references('id')->on('fornecedor');
            $table->string('revisao')->nullable(true);
            $table->date('validade')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documento_externo', function (Blueprint $table) {
            $table->dropColumn('fornecedor_id');
            $table->dropColumn('revisao');
            $table->dropColumn('validade');
        });
    }
}
