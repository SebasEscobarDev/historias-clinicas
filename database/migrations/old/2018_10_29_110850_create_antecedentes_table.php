<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntecedentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_id');
            $table->text('motivo_consulta');
            $table->text('enfermedad_actual');
            $table->text('antecedentes_alergicos');
            $table->text('antecedentes_personales');
            $table->text('antecedentes_familiares');
            $table->text('af_enfermedad_mental');
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
        Schema::dropIfExists('antecedentes');
    }
}
