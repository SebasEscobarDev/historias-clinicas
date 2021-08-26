<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesMedicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_medicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_id');
            $table->integer('td');
            $table->string('formula');
            $table->date('fecha');
            $table->integer('entidad');
            $table->integer('profesional_medico');
            $table->text('antecedentes_alergicos');
            $table->text('medicamentos');
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
        Schema::dropIfExists('ordenes_medicas');
    }
}
