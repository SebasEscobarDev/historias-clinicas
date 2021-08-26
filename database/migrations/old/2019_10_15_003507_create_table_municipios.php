<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMunicipios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ide_municipio')->nullable();
            $table->integer('codigo_municipio')->nullable();
            $table->string('municipio', 50)->nullable();
            $table->integer('ide_departamento')->nullable();
            $table->integer('codigo_departamento')->nullable();
            $table->string('departamento', 50)->nullable();
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
