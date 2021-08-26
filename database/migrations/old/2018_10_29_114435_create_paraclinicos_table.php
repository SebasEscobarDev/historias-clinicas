<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParaclinicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paraclinicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_id');
            $table->integer('td');
            $table->integer('solicitud');
            $table->date('fecha');
            $table->integer('entidad');
            $table->integer('profesional_medico');
            $table->text('diagnosticos');
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
        Schema::dropIfExists('paraclinicos');
    }
}
