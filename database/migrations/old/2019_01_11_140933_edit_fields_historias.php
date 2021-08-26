<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditFieldsHistorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historias', function (Blueprint $table) {
            $table->dropColumn('documento');
            $table->dropColumn('edad');
            $table->renameColumn('paciente', 'paciente_id');
            $table->integer('activo')->after('telefono');
            $table->string('hora_historia', 20)->change();
            $table->string('telefono', 30)->change();
            $table->date('f_egreso')->nullable()->change();
            $table->string('acompañante')->nullable()->change();
            $table->string('parentesco')->nullable()->change();
            $table->integer('telefono')->nullable()->change();
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
