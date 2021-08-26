<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditFieldDxtratamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dxtratamiento', function (Blueprint $table) {
            $table->string('egreso')->nullable()->change();
            $table->string('relacionado_1')->nullable()->change();
            $table->string('relacionado_2')->nullable()->change();
            $table->text('impresion_dx')->nullable()->change();
            $table->text('notas_privadas')->nullable()->change();
            $table->text('tratamiento')->nullable()->change();
            $table->text('observaciones')->nullable()->change();
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
