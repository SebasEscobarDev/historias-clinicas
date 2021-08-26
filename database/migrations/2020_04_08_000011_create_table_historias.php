<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
       
        Schema::create('historias', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('paciente_id');
            //$table->increments('f_historia');
            $table->unsignedInteger('entidad_id');
            $table->unsignedInteger('medico_especialista_id');
            //$table->increments('hora_historia');
            $table->string('acompanante')->nullable();
            $table->string('parentesco', 50)->nullable();
            $table->bigInteger('telefono')->nullable();
            $table->char('activo', 1);
            $table->dateTime('f_egreso')->nullable();
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('entidad_id')->references('id')->on('entidades');
            $table->foreign('medico_especialista_id')->references('id')->on('medicos_especialistas');
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
        Schema::dropIfExists('historias');
    }
}
