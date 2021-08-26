<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedicosEspecialistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('medicos_especialistas', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('nombre', 50)->nullable();
            $table->bigInteger('nit')->nullable();
            $table->string('direccion', 50)->nullable();
            $table->bigInteger('telefono')->nullable();
            $table->bigInteger('celular')->nullable();       
            $table->string('registro_medico')->nullable();
            $table->string('horario_consulta')->nullable();
            $table->string('horario_procedimientos')->nullable();
            $table->string('horario_cirujias')->nullable();
            $table->string('cargo')->nullable();
            $table->string('especialidad_profesional')->nullable();
            $table->integer('activo')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('medicos__especialistas');
    }
}
