<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoriaOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ordenes', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('historia_id');
            $table->integer('td')->nullable();
            $table->integer('formula')->nullable();
            $table->dateTime('fecha')->nullable();
            $table->unsignedInteger('entidad_id');
            $table->unsignedInteger('medico_especialista_id');
            $table->longText('medicamentos')->nullable();            
            
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
        Schema::dropIfExists('ordenes');
    }
}
