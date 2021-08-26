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
        Schema::create('historia_ordenes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('historia_id');
            $table->integer('td');
            $table->integer('formula');
            $table->date('fecha');
            $table->integer('entidad');
            $table->integer('profesional_medico');
            $table->string('ac_alergicos');
            $table->json('medicamentos');
            $table->timestamps();
            $table->foreign('historia_id')->references('id')->on('historias');
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
