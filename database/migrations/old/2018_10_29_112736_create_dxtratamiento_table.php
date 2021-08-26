<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDxtratamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dxtratamiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_id');
            $table->string('ingreso');
            $table->string('egreso');
            $table->string('relacionado_1');
            $table->string('relacionado_2');
            $table->text('impresion_dx');
            $table->text('notas_privadas');
            $table->text('tratamiento');
            $table->text('observaciones');
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
        Schema::dropIfExists('dxtratamiento');
    }
}
