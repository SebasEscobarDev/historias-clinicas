<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_id');
            $table->integer('td');
            $table->integer('remision');
            $table->date('f_remision');
            $table->string('hora_remision');
            $table->integer('entidad');
            $table->integer('profesional_medico');
            $table->string('especialidad_remision');
            $table->string('diagnostico');
            $table->text('enfermedad_actual');
            $table->date('contra');
            $table->text('hallazgos');
            $table->text('examenes');
            $table->text('tratamiento');
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
        Schema::dropIfExists('referencia');
    }
}
