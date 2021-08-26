<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_id');
            $table->string('tension_arterial');
            $table->string('fc_lxm');
            $table->string('fr_rxm');
            $table->string('temperatura');
            $table->string('peso');
            $table->string('talla');
            $table->string('imc');
            $table->text('exploracion_general');
            $table->text('otros_resultados');
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
        Schema::dropIfExists('examenes');
    }
}
