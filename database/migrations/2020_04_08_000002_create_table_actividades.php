<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('actividades', function (Blueprint $table){
            $table->increments('id');
            $table->string('codigo_prc', 10)->nullable();
            $table->string('codigo_alt', 10)->nullable();
            $table->string('codigo_man', 10)->nullable();
            $table->string('codigo_gru', 10)->nullable();
            $table->string('codigo_qui', 10)->nullable();
            $table->string('valor_unid', 10)->nullable();
            $table->string('numero_uni', 10)->nullable();
            $table->string('identifica', 1)->nullable();
            $table->string('nom_proced')->nullable();
            $table->integer('valor_tar1')->nullable();
            $table->integer('valor_tar6')->nullable();
            $table->string('codigo_liq', 5)->nullable();
            $table->integer('codigo_rip')->nullable();
            $table->string('estado_act', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('actividades');
    }
}
