<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEntidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //entities
        Schema::create('entidades', function (Blueprint $table){
            $table->increments('id');
            $table->string('cod_alt_en', 10)->nullable();
            $table->string('nit_entidad', 15)->nullable();
            $table->string('nombre_entidad', 50)->nullable();
            $table->string('direccion', 50)->nullable();
            $table->string('telefonos', 30)->nullable();
            $table->string('email', 20)->nullable();
            $table->smallInteger('codigo_tar')->nullable();
            $table->smallInteger('porce_ajus')->nullable();
            $table->smallInteger('porce_incr')->nullable();
            $table->smallInteger('porce_iva')->nullable();
            $table->smallInteger('porce_desc')->nullable();
            $table->smallInteger('porce_inme')->nullable();
            $table->smallInteger('codigo_usu')->nullable();
            $table->smallInteger('codigo_man')->nullable();
            $table->smallInteger('tipo_entid')->nullable();
            $table->char('activo', 1)->nullable();
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
        Schema::dropIfExists('entidades');
    }
}
