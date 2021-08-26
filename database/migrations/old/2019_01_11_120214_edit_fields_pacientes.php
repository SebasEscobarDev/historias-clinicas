<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditFieldsPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('nombre_2')->nullable()->change();
            $table->bigInteger('telefono')->nullable()->change();
            $table->bigInteger('celular')->nullable()->change();
            $table->string('clase')->change();
            $table->string('afiliacion')->change();
            $table->string('ocupacion')->change();
            $table->string('municipio')->change();
            $table->string('depto')->change();
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
