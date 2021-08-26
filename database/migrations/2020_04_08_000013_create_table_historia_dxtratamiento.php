<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoriaDxtratamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dxtratamiento', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('historia_id');
            $table->string('ingreso', 100)->nullable();
            $table->string('egreso', 100)->nullable();
            $table->string('relacionado_1', 100)->nullable();
            $table->string('relacionado_2', 100)->nullable();
            $table->text('impresion_dx')->nullable();
            $table->text('notas_privadas')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('dxtratamiento');
    }
}
