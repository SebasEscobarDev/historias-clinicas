<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsHistoriaReferencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historia_referencia', function (Blueprint $table) {
            $table->renameColumn('f_remision', 'fecha');
            $table->renameColumn('hora_remision', 'hora');
            $table->renameColumn('especialidad_remision', 'especialidad');
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

