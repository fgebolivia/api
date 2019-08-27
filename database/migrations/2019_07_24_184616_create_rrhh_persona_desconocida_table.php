<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRrhhPersonaDesconocidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrhh_persona_desconocida', function(Blueprint $table){
            $table->increments('id');
            $table->integer('pais_id')->unsigned()->nullable();
            $table->smallInteger('estado')->default('1')->unsigned();
            $table->string('nombre', 50)->nullable();
            $table->string('ap_paterno', 50)->nullable();
            $table->string('ap_materno', 50)->nullable();
            $table->text('descripcion')->nullable();
            $table->foreign('pais_id')
                ->references('id')
                ->on('ubge_pais');
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
        Schema::dropIfExists('rrhh_persona_desconocida');
    }
}
