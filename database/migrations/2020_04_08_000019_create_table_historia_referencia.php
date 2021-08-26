<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoriaReferencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('referencias', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('historia_id');
            $table->integer('td')->nullable();
            $table->integer('remision')->nullable();
            $table->dateTime('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->unsignedInteger('entidad_id');
            $table->unsignedInteger('medico_especialista_id');
            $table->string('especialidad')->nullable();
            $table->string('diagnostico')->nullable();
            $table->text('enfermedad_actual')->nullable();
            $table->dateTime('contra')->nullable();
            $table->text('hallazgos')->nullable();
            $table->text('examenes')->nullable();
            $table->text('tratamiento')->nullable();

            $table->foreign('historia_id')->references('id')->on('historias');
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
        Schema::dropIfExists('referencias');
    }
}
