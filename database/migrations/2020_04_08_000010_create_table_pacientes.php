<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('pacientes', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('identificacion_id')->nullable();
            $table->bigInteger('documento')->nullable();
            $table->string('nombre_1')->nullable();
            $table->string('nombre_2')->nullable();
            $table->string('apellido_1')->nullable();
            $table->string('apellido_2')->nullable();
            $table->dateTime('f_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->string('rh')->nullable();
            $table->string('sexo')->nullable();
            $table->string('direccion')->nullable();
            $table->bigInteger('telefono')->nullable();
            $table->bigInteger('celular')->nullable();
            $table->string('correo')->nullable();
            $table->integer('clase')->nullable();
            $table->integer('afiliacion')->nullable();
            $table->integer('ocupacion')->nullable();
            $table->unsignedInteger('municipio_id')->nullable();
            $table->unsignedInteger('departamento_id')->nullable();
            $table->char('activo', 1)->nullable();

            $table->foreign('identificacion_id')->references('id')->on('identificacion');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
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
        Schema::dropIfExists('pacientes');
    }
}
