<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoriaIncapacidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('incapacidades', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('historia_id');
            $table->integer('td')->nullable();
            $table->integer('incapacidad')->nullable();
            $table->dateTime('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->unsignedInteger('entidad_id');
            $table->unsignedInteger('medico_especialista_id');
            $table->integer('clase_incapacidad')->nullable();
            $table->integer('tipo_incapacidad')->nullable();
            $table->integer('dias')->nullable();
            $table->dateTime('inicio')->nullable();
            $table->dateTime('finalizacion')->nullable();
            $table->string('txt_dias')->nullable();
            $table->string('diagnostico')->nullable();
            $table->text('descripcion')->nullable();

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
        Schema::dropIfExists('incapacidades');

    }
}
