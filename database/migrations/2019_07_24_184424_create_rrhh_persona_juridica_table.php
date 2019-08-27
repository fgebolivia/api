<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRrhhPersonaJuridicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrhh_persona_juridica', function(Blueprint $table){
            $table->increments('id');
            $table->integer('municipio_id')->unsigned()->nullable();
            $table->smallInteger('estado')->default('1')->unsigned();
            $table->string('razon_social', 250)->nullable();
            $table->string('nit', 25)->nullable();
            $table->string('domicilio', 250)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->timestamps();
            $table->foreign('municipio_id')
                ->references('id')
                ->on('ubge_municipios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rrhh_persona_juridica');
    }
}
