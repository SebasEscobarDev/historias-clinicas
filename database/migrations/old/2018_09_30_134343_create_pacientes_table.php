<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_id');
            $table->bigInteger('documento');
            $table->string('nombre_1');
            $table->string('nombre_2');
            $table->string('apellido_1');
            $table->string('apellido_2');
            $table->date('f_nacimiento');
            $table->integer('edad');
            $table->string('rh');
            $table->string('sexo');
            $table->string('direccion');
            $table->bigInteger('telefono');
            $table->bigInteger('celular');
            $table->integer('clase');
            $table->integer('afiliacion');
            $table->integer('ocupacion');
            $table->integer('municipio');
            $table->integer('depto');
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
        Schema::dropIfExists('pacientes');
    }
}
