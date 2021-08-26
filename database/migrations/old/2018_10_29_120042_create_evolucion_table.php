<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvolucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_id');
            $table->integer('td');
            $table->integer('control');
            $table->date('fecha');
            $table->integer('entidad');
            $table->integer('profesional_medico');
            $table->text('subjetivo');
            $table->text('objetivo');
            $table->text('descripcion');
            $table->text('observaciones');
            $table->integer('intervencion');
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
        Schema::dropIfExists('evolucion');
    }
}
