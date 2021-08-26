<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('medicamentos', function (Blueprint $table){
            $table->increments('id');
            $table->string('codigo_cum', 100)->nullable();
            $table->string('codigo_atc', 100)->nullable();
            $table->smallInteger('codigo_tip')->nullable();
            $table->smallInteger('clase_prod')->nullable();
            $table->smallInteger('clase_apli')->nullable();
            $table->string('nombre_far', 100)->nullable();
            $table->string('nombre_gen', 100)->nullable();
            $table->string('presentacion', 100)->nullable();
            $table->string('unidad_med', 100)->nullable();
            $table->string('unidad_int', 100)->nullable();
            $table->string('concentrac', 100)->nullable();
            $table->string('via_admini', 100)->nullable();
            $table->string('referencia', 100)->nullable();
            $table->string('reg_invima', 100)->nullable();
            $table->bigInteger('valor_cost')->nullable();
            $table->bigInteger('valor_coiv')->nullable();
            $table->bigInteger('valor_vent')->nullable();
            $table->smallInteger('codtip_ser')->nullable();
            $table->smallInteger('porce_iva')->nullable();
            $table->smallInteger('porce_incr')->nullable();
            $table->integer('saldo_actu')->nullable();
            $table->smallInteger('idcod_cent')->nullable();
            $table->string('realizar_m', 100)->nullable();
            $table->string('estado_act', 100)->nullable();

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
        Schema::dropIfExists('medicamentos');
    }
}
