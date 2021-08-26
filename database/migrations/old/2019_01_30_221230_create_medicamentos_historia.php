<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentosHistoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos_historia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('historia_id');
            $table->integer('grupo');
            $table->bigInteger('medicamento_id');
            $table->string('descripcion');
            $table->string('presentacion');
            $table->integer('cantidad');
            $table->string('dosis');
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
    }
}
