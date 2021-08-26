<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoriaEvolucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('evoluciones', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('historia_id');
            $table->integer('td')->nullable();
            $table->integer('control')->nullable();
            $table->dateTime('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->unsignedInteger('entidad_id');
            $table->unsignedInteger('medico_especialista_id');
            $table->text('subjetivo')->nullable();
            $table->text('objetivo')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('observaciones')->nullable();
            $table->integer('intervencion')->nullable();

            $table->foreign('entidad_id')->references('id')->on('entidades');
            $table->foreign('historia_id')->references('id')->on('historias');
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
        Schema::dropIfExists('evoluciones');
    }
}
