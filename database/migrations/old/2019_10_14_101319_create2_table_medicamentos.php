<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create2TableMedicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_cum', 20)->nullable();
            $table->string('codigo_atc', 20)->nullable();
            $table->smallInteger('codigo_tip')->nullable();
            $table->smallInteger('clase_prod')->nullable();
            $table->smallInteger('clase_apli')->nullable();
            $table->string('nombre_far', 100)->nullable();
            $table->string('nombre_gen', 100)->nullable();
            $table->string('presentacion', 30)->nullable();
            $table->string('unidad_med', 15)->nullable();
            $table->string('unidad_int', 10)->nullable();
            $table->string('concentrac', 30)->nullable();
            $table->string('via_admini', 10)->nullable();
            $table->string('referencia', 10)->nullable();
            $table->string('reg_invima', 10)->nullable();
            $table->bigInteger('valor_cost')->nullable();
            $table->bigInteger('valor_vent')->nullable();
            $table->smallInteger('codtip_ser')->nullable();
            $table->smallInteger('porce_iva')->nullable();
            $table->smallInteger('porce_incr')->nullable();
            $table->Integer('saldo_actu')->nullable();
            $table->smallInteger('idcod_cent')->nullable();
            $table->string('realizar_m', 5)->nullable();
            $table->string('estado_act', 5)->nullable();
            $table->timestamps();
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
    }
}
