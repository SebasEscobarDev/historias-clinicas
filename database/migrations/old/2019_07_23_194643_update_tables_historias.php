<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTablesHistorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('historia_antecedentes', function (Blueprint $table) {
            $table->text('motivo_consulta')->nullable()->change();
            $table->text('enfermedad_actual')->nullable()->change();
            $table->text('antecedentes_alergicos')->nullable()->change();
            $table->text('antecedentes_personales')->nullable()->change();
            $table->text('antecedentes_familiares')->nullable()->change();
            $table->text('af_enfermedad_mental')->nullable()->change();
        });

        Schema::table('historia_examenes', function (Blueprint $table) {
            $table->string('tension_arterial')->nullable()->change();
            $table->string('fc_lxm')->nullable()->change();
            $table->string('fr_rxm')->nullable()->change();
            $table->string('temperatura')->nullable()->change();
            $table->string('peso')->nullable()->change();
            $table->string('talla')->nullable()->change();
            $table->string('imc')->nullable()->change();
            $table->text('exploracion_general')->nullable()->change();
            $table->text('otros_resultados')->nullable()->change();
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
