<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTablesAllHistoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('antecedentes', 'historia_antecedentes');
        Schema::rename('examenes', 'historia_examenes');
        Schema::rename('dxtratamiento', 'historia_dxtratamiento');
        Schema::rename('paraclinicos', 'historia_paraclinicos');
        Schema::rename('incapacidades', 'historia_incapacidades');
        Schema::rename('referencia', 'historia_referencia');
        Schema::rename('evolucion', 'historia_evolucion');
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
