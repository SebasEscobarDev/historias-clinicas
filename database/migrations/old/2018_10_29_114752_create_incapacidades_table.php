<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncapacidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incapacidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_id');
            $table->integer('td');
            $table->integer('incapacidad');
            $table->date('fecha');
            $table->string('hora');
            $table->integer('entidad');
            $table->integer('profesional_medico');
            $table->integer('clase_incapacidad');
            $table->integer('tipo_incapacidad');
            $table->integer('dias');
            $table->date('inicio');
            $table->date('finalizacion');
            $table->string('txt_dias');
            $table->string('diagnostico');
            $table->text('descripcion');
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
        Schema::dropIfExists('incapacidades');
    }
}
