<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicoEspecialistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos_especialistas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('nombre');
            $table->bigInteger('nit');
            $table->string('direccion');
            $table->bigInteger('telefono');
            $table->bigInteger('celular');
            $table->string('registro_medico');
            $table->string('horario_consulta');
            $table->string('horario_procedimientos');
            $table->string('horario_cirujias');
            $table->string('cargo');
            $table->string('especialidad_profesional');
            $table->integer('activo');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medico_especialistas');
    }
}
