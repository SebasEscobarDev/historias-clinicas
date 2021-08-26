<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('documento');
            $table->string('paciente');
            $table->integer('edad');
            $table->date('f_historia');
            $table->date('f_egreso');
            $table->integer('entidad');
            $table->integer('profesional_medico');
            $table->string('hora_historia');
            $table->string('acompañante');
            $table->string('parentesco');
            $table->integer('telefono');
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
        Schema::dropIfExists('historias');
    }
}
