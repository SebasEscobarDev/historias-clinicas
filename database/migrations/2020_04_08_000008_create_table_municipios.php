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
        //
        Schema::create('municipios', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('departamento_id')->nullable();
            $table->integer('codigo')->nullable();
            $table->string('nombre')->nullable();

            $table->foreign('departamento_id')->references('id')->on('departamentos');
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
        Schema::dropIfExists('municipios');
    }
}
