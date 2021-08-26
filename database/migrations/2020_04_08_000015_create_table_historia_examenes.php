<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoriaExamenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('examenes', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('historia_id');
            
            $table->string('tension_arterial')->nullable();
            $table->string('fc_lxm')->nullable();
            $table->string('fr_rxm')->nullable();
            $table->string('temperatura')->nullable();
            $table->string('peso')->nullable();
            $table->string('talla')->nullable();
            $table->string('imc')->nullable();
            $table->text('exploracion_general')->nullable();
            $table->text('otros_resultados')->nullable();

            $table->foreign('historia_id')->references('id')->on('historias');
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
        Schema::dropIfExists('examenes');
    }
}
